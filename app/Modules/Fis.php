<?php

namespace App\Modules;


class Fis
{
    // {{{ constants

    const PATTERN_UPDATED = '/<td class="updatedtime">UPDATED: (.*)<\/td>/';
    const PATTERN_DATE    = '/<td colspan="6" class="sumheadtop"> (.*)<\/td>/';
    const PATTERN_ENTRIES = '/DOMESTIC &amp; INTERNATIONAL(.*)(summaryhead|<\/table>)/Us';
    const PATTERN_ENTRY    = '/<tr class="schedulerow.*" valign="top">(.*)<\/tr>/Us';

    // }}}

    // {{{ properties

    /**
     * Time of last update to flight data
     * Time is in unix timestamp format
     *
     * @var integer
     * @access public
     */
    public $updatedAt;

    // }}}


    // {{{ getFlights

    /**
     * Gets flight data as specified
     *
     * @param string	$type		Set to fetch 'arrivals' or 'departures' data
     * @return boolean	True if flight is processed successfully, false if not.
     *
     * @access public
     */
    public function getFlights($type = 'arrivals')
    {
        // Check whether to get arrival or departure data
        if ($type == 'arrivals') {
            $link = 'http://www.fis.com.mv/cgi-bin/webfids.pl?webfids_type=arrivals';
        } else {
            $link = 'http://www.fis.com.mv/cgi-bin/webfids.pl?webfids_type=departures';
        }

        // Setup regular expression patterns for data extraction


        // Execute main code with exception handling
        try {
            $scheduledAt = null;
            $estimatedAt = null;

            // Fetch data from FIS site
            $data = file_get_contents($link);

            // Extract update time
            preg_match(self::PATTERN_UPDATED, $data, $matches);
            $matches[1] = str_replace(array('|', ','), '', $matches[1]);
            $this->updatedAt = strtotime($matches[1]);

            // Locate entries
            // Return with failure if no entries can be found
            $entries = array();
            if (!preg_match_all(self::PATTERN_ENTRIES, $data, $daymatches)) return false;

            // Clear unneeded memory
            unset($data);

            // Loop through the each day listing
            while ($daymatches[0]) {

                // Get next day
                $daymatch = array_shift($daymatches[0]);

                // Extract date for listing
                if (preg_match(self::PATTERN_DATE, $daymatch, $temp)) {
                    $date = strtotime($temp[1]);
                }

                // Extract entries for the day
                preg_match_all(self::PATTERN_ENTRY, $daymatch, $matches);

                // Process the extracted entries
                while ($matches[1]) {

                    // Get next entry
                    $match = array_shift($matches[1]);

                    // Start off new entry with data element
                    $fdata = array();

                    // Extract the fields
                    preg_match_all('/<td class="(.*)".*>(.*)<\/td>/Us', $match, $temp);

                    // Get airline name and id
                    preg_match('/alt="(.*)"/', $temp[2][0], $fdata['airlineName']);
                    preg_match('/images\/(.*)\./', $temp[2][0], $fdata['airlineId']);
                    $fdata['airlineName'] = $fdata['airlineName'][1];
                    $fdata['airlineId'] = strtoupper($fdata['airlineId'][1]);

                    // Get flightid
                    $fdata['flightId'] = $temp[2][1];

                    // Get route
                    $delim = ($type == 'arrivals') ? ' / ' : ' \ ';
                    $fdata['route'] = explode($delim, $temp[2][2]);

                    // Get time
                    if (!empty($temp[2][3])) {
                        $scheduledAt = $fdata['scheduledAt'] = $temp[2][3];
                    } else {
                        $fdata['scheduledAt'] = $scheduledAt;
                    }

                    // Get estimated time
                    if (!empty($temp[2][4])) {
                        $estimatedAt = $fdata['estimatedAt'] = ($temp[2][4] == '&nbsp;') ? '' : $temp[2][4];
                    } else {
                        $fdata['estimatedAt'] = $estimatedAt;
                    }

                    // Get status
                    $fdata['status'] = ($temp[2][5] == '&nbsp;') ? '' : $temp[2][5];
                    $fdata['status'] = strip_tags($fdata['status']);

                    // Add data to flight listing
                    if (isset($date)) {
                        $flights[$date][] = $fdata;
                    }

                    $flights[] = $fdata;
                }
            }

            // Return success
            return $flights ?? [];
        } catch (Exception $e) {
            // Error occured:

            // Return failure
            return false;
        }
    }

    // }}}

}

// }}}
