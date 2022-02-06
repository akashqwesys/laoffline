<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Settings\Country;

class CreateCountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countries = [
            [
                'id' => '1', 
                'country_code' => 'AD', 
                'name' => 'Andorra'
            ],
            [
                'id' => '2', 
                'country_code' => 'AE', 
                'name' => 'United Arab Emirates'
            ],
            [
                'id' => '3', 
                'country_code' => 'AF', 
                'name' => 'Afghanistan'
            ],
            [
                'id' => '4', 
                'country_code' => 'AG', 
                'name' => 'Antigua and Barbuda'
            ],
            [
                'id' => '5', 
                'country_code' => 'AI', 
                'name' => 'Anguilla'
            ],
            [
                'id' => '6', 
                'country_code' => 'AL', 
                'name' => 'Albania'
            ],
            [
                'id' => '7', 
                'country_code' => 'AM', 
                'name' => 'Armenia'
            ],
            [
                'id' => '8', 
                'country_code' => 'AO', 
                'name' => 'Angola'
            ],
            [
                'id' => '9', 
                'country_code' => 'AQ', 
                'name' => 'Antarctica'
            ],
            [
                'id' => '10', 
                'country_code' => 'AR', 
                'name' => 'Argentina'
            ],
            [
                'id' => '11', 
                'country_code' => 'AS', 
                'name' => 'American Samoa'
            ],
            [
                'id' => '12', 
                'country_code' => 'AT', 
                'name' => 'Austria'
            ],
            [
                'id' => '13', 
                'country_code' => 'AU', 
                'name' => 'Australia'
            ],
            [
                'id' => '14', 
                'country_code' => 'AW', 
                'name' => 'Aruba'
            ],
            [
                'id' => '15', 
                'country_code' => 'AX', 
                'name' => 'Aland'
            ],
            [
                'id' => '16', 
                'country_code' => 'AZ', 
                'name' => 'Azerbaijan'
            ],
            [
                'id' => '17', 
                'country_code' => 'BA', 
                'name' => 'Bosnia and Herzegovina'
            ],
            [
                'id' => '18', 
                'country_code' => 'BB', 
                'name' => 'Barbados'
            ],
            [
                'id' => '19', 
                'country_code' => 'BD', 
                'name' => 'Bangladesh'
            ],
            [
                'id' => '20', 
                'country_code' => 'BE', 
                'name' => 'Belgium'
            ],
            [
                'id' => '21', 
                'country_code' => 'BF', 
                'name' => 'Burkina Faso'
            ],
            [
                'id' => '22', 
                'country_code' => 'BG', 
                'name' => 'Bulgaria'
            ],
            [
                'id' => '23', 
                'country_code' => 'BH', 
                'name' => 'Bahrain'
            ],
            [
                'id' => '24', 
                'country_code' => 'BI', 
                'name' => 'Burundi'
            ],
            [
                'id' => '25', 
                'country_code' => 'BJ', 
                'name' => 'Benin'
            ],
            [
                'id' => '26', 
                'country_code' => 'BL', 
                'name' => 'Saint Barthélemy'
            ],
            [
                'id' => '27', 
                'country_code' => 'BM', 
                'name' => 'Bermuda'
            ],
            [
                'id' => '28', 
                'country_code' => 'BN', 
                'name' => 'Brunei'
            ],
            [
                'id' => '29', 
                'country_code' => 'BO', 
                'name' => 'Bolivia'
            ],
            [
                'id' => '30', 
                'country_code' => 'BQ', 
                'name' => 'Bonaire'
            ],
            [
                'id' => '31', 
                'country_code' => 'BR', 
                'name' => 'Brazil'
            ],
            [
                'id' => '32', 
                'country_code' => 'BS', 
                'name' => 'Bahamas'
            ],
            [
                'id' => '33', 
                'country_code' => 'BT', 
                'name' => 'Bhutan'
            ],
            [
                'id' => '34', 
                'country_code' => 'BV', 
                'name' => 'Bouvet Island'
            ],
            [
                'id' => '35', 
                'country_code' => 'BW', 
                'name' => 'Botswana'
            ],
            [
                'id' => '36', 
                'country_code' => 'BY', 
                'name' => 'Belarus'
            ],
            [
                'id' => '37', 
                'country_code' => 'BZ', 
                'name' => 'Belize'
            ],
            [
                'id' => '38', 
                'country_code' => 'CA', 
                'name' => 'Canada'
            ],
            [
                'id' => '39', 
                'country_code' => 'CC', 
                'name' => 'Cocos [Keeling] Islands'
            ],
            [
                'id' => '40', 
                'country_code' => 'CD', 
                'name' => 'Democratic Republic of the Congo'
            ],
            [
                'id' => '41', 
                'country_code' => 'CF', 
                'name' => 'Central African Republic'
            ],
            [
                'id' => '42', 
                'country_code' => 'CG', 
                'name' => 'Republic of the Congo'
            ],
            [
                'id' => '43', 
                'country_code' => 'CH', 
                'name' => 'Switzerland'
            ],
            [
                'id' => '44', 
                'country_code' => 'CI', 
                'name' => 'Ivory Coast'
            ],
            [
                'id' => '45', 
                'country_code' => 'CK', 
                'name' => 'Cook Islands'
            ],
            [
                'id' => '46', 
                'country_code' => 'CL', 
                'name' => 'Chile'
            ],
            [
                'id' => '47', 
                'country_code' => 'CM', 
                'name' => 'Cameroon'
            ],
            [
                'id' => '48', 
                'country_code' => 'CN', 
                'name' => 'China'
            ],
            [
                'id' => '49', 
                'country_code' => 'CO', 
                'name' => 'Colombia'
            ],
            [
                'id' => '50', 
                'country_code' => 'CR', 
                'name' => 'Costa Rica'
            ],
            [
                'id' => '51', 
                'country_code' => 'CU', 
                'name' => 'Cuba'
            ],
            [
                'id' => '52', 
                'country_code' => 'CV', 
                'name' => 'Cape Verde'
            ],
            [
                'id' => '53', 
                'country_code' => 'CW', 
                'name' => 'Curacao'
            ],
            [
                'id' => '54', 
                'country_code' => 'CX', 
                'name' => 'Christmas Island'
            ],
            [
                'id' => '55', 
                'country_code' => 'CY', 
                'name' => 'Cyprus'
            ],
            [
                'id' => '56', 
                'country_code' => 'CZ', 
                'name' => 'Czech Republic'
            ],
            [
                'id' => '57', 
                'country_code' => 'DE', 
                'name' => 'Germany'
            ],
            [
                'id' => '58', 
                'country_code' => 'DJ', 
                'name' => 'Djibouti'
            ],
            [
                'id' => '59', 
                'country_code' => 'DK', 
                'name' => 'Denmark'
            ],
            [
                'id' => '60', 
                'country_code' => 'DM', 
                'name' => 'Dominica'
            ],
            [
                'id' => '61', 
                'country_code' => 'DO', 
                'name' => 'Dominican Republic'
            ],
            [
                'id' => '62', 
                'country_code' => 'DZ', 
                'name' => 'Algeria'
            ],
            [
                'id' => '63', 
                'country_code' => 'EC', 
                'name' => 'Ecuador'
            ],
            [
                'id' => '64', 
                'country_code' => 'EE', 
                'name' => 'Estonia'
            ],
            [
                'id' => '65', 
                'country_code' => 'EG', 
                'name' => 'Egypt'
            ],
            [
                'id' => '66', 
                'country_code' => 'EH', 
                'name' => 'Western Sahara'
            ],
            [
                'id' => '67', 
                'country_code' => 'ER', 
                'name' => 'Eritrea'
            ],
            [
                'id' => '68', 
                'country_code' => 'ES', 
                'name' => 'Spain'
            ],
            [
                'id' => '69', 
                'country_code' => 'ET', 
                'name' => 'Ethiopia'
            ],
            [
                'id' => '70', 
                'country_code' => 'FI', 
                'name' => 'Finland'
            ],
            [
                'id' => '71', 
                'country_code' => 'FJ', 
                'name' => 'Fiji'
            ],
            [
                'id' => '72', 
                'country_code' => 'FK', 
                'name' => 'Falkland Islands'
            ],
            [
                'id' => '73', 
                'country_code' => 'FM', 
                'name' => 'Micronesia'
            ],
            [
                'id' => '74', 
                'country_code' => 'FO', 
                'name' => 'Faroe Islands'
            ],
            [
                'id' => '75', 
                'country_code' => 'FR', 
                'name' => 'France'
            ],
            [
                'id' => '76', 
                'country_code' => 'GA', 
                'name' => 'Gabon'
            ],
            [
                'id' => '77', 
                'country_code' => 'GB', 
                'name' => 'United Kingdom'
            ],
            [
                'id' => '78', 
                'country_code' => 'GD', 
                'name' => 'Grenada'
            ],
            [
                'id' => '79', 
                'country_code' => 'GE', 
                'name' => 'Georgia'
            ],
            [
                'id' => '80', 
                'country_code' => 'GF', 
                'name' => 'French Guiana'
            ],
            [
                'id' => '81', 
                'country_code' => 'GG', 
                'name' => 'Guernsey'
            ],
            [
                'id' => '82', 
                'country_code' => 'GH', 
                'name' => 'Ghana'
            ],
            [
                'id' => '83', 
                'country_code' => 'GI', 
                'name' => 'Gibraltar'
            ],
            [
                'id' => '84', 
                'country_code' => 'GL', 
                'name' => 'Greenland'
            ],
            [
                'id' => '85', 
                'country_code' => 'GM', 
                'name' => 'Gambia'
            ],
            [
                'id' => '86', 
                'country_code' => 'GN', 
                'name' => 'Guinea'
            ],
            [
                'id' => '87', 
                'country_code' => 'GP', 
                'name' => 'Guadeloupe'
            ],
            [
                'id' => '88', 
                'country_code' => 'GQ', 
                'name' => 'Equatorial Guinea'
            ],
            [
                'id' => '89', 
                'country_code' => 'GR', 
                'name' => 'Greece'
            ],
            [
                'id' => '90', 
                'country_code' => 'GS', 
                'name' => 'South Georgia and the South Sandwich Islands'
            ],
            [
                'id' => '91', 
                'country_code' => 'GT', 
                'name' => 'Guatemala'
            ],
            [
                'id' => '92', 
                'country_code' => 'GU', 
                'name' => 'Guam'
            ],
            [
                'id' => '93', 
                'country_code' => 'GW', 
                'name' => 'Guinea-Bissau'
            ],
            [
                'id' => '94', 
                'country_code' => 'GY', 
                'name' => 'Guyana'
            ],
            [
                'id' => '95', 
                'country_code' => 'HK', 
                'name' => 'Hong Kong'
            ],
            [
                'id' => '96', 
                'country_code' => 'HM', 
                'name' => 'Heard Island and McDonald Islands'
            ],
            [
                'id' => '97', 
                'country_code' => 'HN', 
                'name' => 'Honduras'
            ],
            [
                'id' => '98', 
                'country_code' => 'HR', 
                'name' => 'Croatia'
            ],
            [
                'id' => '99', 
                'country_code' => 'HT', 
                'name' => 'Haiti'
            ],
            [
                'id' => '100', 
                'country_code' => 'HU', 
                'name' => 'Hungary'
            ],
            [
                'id' => '101', 
                'country_code' => 'ID', 
                'name' => 'Indonesia'
            ],
            [
                'id' => '102', 
                'country_code' => 'IE', 
                'name' => 'Ireland'
            ],
            [
                'id' => '103', 
                'country_code' => 'IL', 
                'name' => 'Israel'
            ],
            [
                'id' => '104', 
                'country_code' => 'IM', 
                'name' => 'Isle of Man'
            ],
            [
                'id' => '105', 
                'country_code' => 'IN', 
                'name' => 'India'
            ],
            [
                'id' => '106', 
                'country_code' => 'IO', 
                'name' => 'British Indian Ocean Territory'
            ],
            [
                'id' => '107', 
                'country_code' => 'IQ', 
                'name' => 'Iraq'
            ],
            [
                'id' => '108', 
                'country_code' => 'IR', 
                'name' => 'Iran'
            ],
            [
                'id' => '109', 
                'country_code' => 'IS', 
                'name' => 'Iceland'
            ],
            [
                'id' => '110', 
                'country_code' => 'IT', 
                'name' => 'Italy'
            ],
            [
                'id' => '111', 
                'country_code' => 'JE', 
                'name' => 'Jersey'
            ],
            [
                'id' => '112', 
                'country_code' => 'JM', 
                'name' => 'Jamaica'
            ],
            [
                'id' => '113', 
                'country_code' => 'JO', 
                'name' => 'Jordan'
            ],
            [
                'id' => '114', 
                'country_code' => 'JP', 
                'name' => 'Japan'
            ],
            [
                'id' => '115', 
                'country_code' => 'KE', 
                'name' => 'Kenya'
            ],
            [
                'id' => '116', 
                'country_code' => 'KG', 
                'name' => 'Kyrgyzstan'
            ],
            [
                'id' => '117', 
                'country_code' => 'KH', 
                'name' => 'Cambodia'
            ],
            [
                'id' => '118', 
                'country_code' => 'KI', 
                'name' => 'Kiribati'
            ],
            [
                'id' => '119', 
                'country_code' => 'KM', 
                'name' => 'Comoros'
            ],
            [
                'id' => '120', 
                'country_code' => 'KN', 
                'name' => 'Saint Kitts and Nevis'
            ],
            [
                'id' => '121', 
                'country_code' => 'KP', 
                'name' => 'North Korea'
            ],
            [
                'id' => '122', 
                'country_code' => 'KR', 
                'name' => 'South Korea'
            ],
            [
                'id' => '123', 
                'country_code' => 'KW', 
                'name' => 'Kuwait'
            ],
            [
                'id' => '124', 
                'country_code' => 'KY', 
                'name' => 'Cayman Islands'
            ],
            [
                'id' => '125', 
                'country_code' => 'KZ', 
                'name' => 'Kazakhstan'
            ],
            [
                'id' => '126', 
                'country_code' => 'LA', 
                'name' => 'Laos'
            ],
            [
                'id' => '127', 
                'country_code' => 'LB', 
                'name' => 'Lebanon'
            ],
            [
                'id' => '128', 
                'country_code' => 'LC', 
                'name' => 'Saint Lucia'
            ],
            [
                'id' => '129', 
                'country_code' => 'LI', 
                'name' => 'Liechtenstein'
            ],
            [
                'id' => '130', 
                'country_code' => 'LK', 
                'name' => 'Sri Lanka'
            ],
            [
                'id' => '131', 
                'country_code' => 'LR', 
                'name' => 'Liberia'
            ],
            [
                'id' => '132', 
                'country_code' => 'LS', 
                'name' => 'Lesotho'
            ],
            [
                'id' => '133', 
                'country_code' => 'LT', 
                'name' => 'Lithuania'
            ],
            [
                'id' => '134', 
                'country_code' => 'LU', 
                'name' => 'Luxembourg'
            ],
            [
                'id' => '135', 
                'country_code' => 'LV', 
                'name' => 'Latvia'
            ],
            [
                'id' => '136', 
                'country_code' => 'LY', 
                'name' => 'Libya'
            ],
            [
                'id' => '137', 
                'country_code' => 'MA', 
                'name' => 'Morocco'
            ],
            [
                'id' => '138', 
                'country_code' => 'MC', 
                'name' => 'Monaco'
            ],
            [
                'id' => '139', 
                'country_code' => 'MD', 
                'name' => 'Moldova'
            ],
            [
                'id' => '140', 
                'country_code' => 'ME', 
                'name' => 'Montenegro'
            ],
            [
                'id' => '141', 
                'country_code' => 'MF', 
                'name' => 'Saint Martin'
            ],
            [
                'id' => '142', 
                'country_code' => 'MG', 
                'name' => 'Madagascar'
            ],
            [
                'id' => '143', 
                'country_code' => 'MH', 
                'name' => 'Marshall Islands'
            ],
            [
                'id' => '144', 
                'country_code' => 'MK', 
                'name' => 'Macedonia'
            ],
            [
                'id' => '145', 
                'country_code' => 'ML', 
                'name' => 'Mali'
            ],
            [
                'id' => '146', 
                'country_code' => 'MM', 
                'name' => 'Myanmar [Burma]'
            ],
            [
                'id' => '147', 
                'country_code' => 'MN', 
                'name' => 'Mongolia'
            ],
            [
                'id' => '148', 
                'country_code' => 'MO', 
                'name' => 'Macao'
            ],
            [
                'id' => '149', 
                'country_code' => 'MP', 
                'name' => 'Northern Mariana Islands'
            ],
            [
                'id' => '150', 
                'country_code' => 'MQ', 
                'name' => 'Martinique'
            ],
            [
                'id' => '151', 
                'country_code' => 'MR', 
                'name' => 'Mauritania'
            ],
            [
                'id' => '152', 
                'country_code' => 'MS', 
                'name' => 'Montserrat'
            ],
            [
                'id' => '153', 
                'country_code' => 'MT', 
                'name' => 'Malta'
            ],
            [
                'id' => '154', 
                'country_code' => 'MU', 
                'name' => 'Mauritius'
            ],
            [
                'id' => '155', 
                'country_code' => 'MV', 
                'name' => 'Maldives'
            ],
            [
                'id' => '156', 
                'country_code' => 'MW', 
                'name' => 'Malawi'
            ],
            [
                'id' => '157', 
                'country_code' => 'MX', 
                'name' => 'Mexico'
            ],
            [
                'id' => '158', 
                'country_code' => 'MY', 
                'name' => 'Malaysia'
            ],
            [
                'id' => '159', 
                'country_code' => 'MZ', 
                'name' => 'Mozambique'
            ],
            [
                'id' => '160', 
                'country_code' => 'NA', 
                'name' => 'Namibia'
            ],
            [
                'id' => '161', 
                'country_code' => 'NC', 
                'name' => 'New Caledonia'
            ],
            [
                'id' => '162', 
                'country_code' => 'NE', 
                'name' => 'Niger'
            ],
            [
                'id' => '163', 
                'country_code' => 'NF', 
                'name' => 'Norfolk Island'
            ],
            [
                'id' => '164', 
                'country_code' => 'NG', 
                'name' => 'Nigeria'
            ],
            [
                'id' => '165', 
                'country_code' => 'NI', 
                'name' => 'Nicaragua'
            ],
            [
                'id' => '166', 
                'country_code' => 'NL', 
                'name' => 'Netherlands'
            ],
            [
                'id' => '167', 
                'country_code' => 'NO', 
                'name' => 'Norway'
            ],
            [
                'id' => '168', 
                'country_code' => 'NP', 
                'name' => 'Nepal'
            ],
            [
                'id' => '169', 
                'country_code' => 'NR', 
                'name' => 'Nauru'
            ],
            [
                'id' => '170', 
                'country_code' => 'NU', 
                'name' => 'Niue'
            ],
            [
                'id' => '171', 
                'country_code' => 'NZ', 
                'name' => 'New Zealand'
            ],
            [
                'id' => '172', 
                'country_code' => 'OM', 
                'name' => 'Oman'
            ],
            [
                'id' => '173', 
                'country_code' => 'PA', 
                'name' => 'Panama'
            ],
            [
                'id' => '174', 
                'country_code' => 'PE', 
                'name' => 'Peru'
            ],
            [
                'id' => '175', 
                'country_code' => 'PF', 
                'name' => 'French Polynesia'
            ],
            [
                'id' => '176', 
                'country_code' => 'PG', 
                'name' => 'Papua New Guinea'
            ],
            [
                'id' => '177', 
                'country_code' => 'PH', 
                'name' => 'Philippines'
            ],
            [
                'id' => '178', 
                'country_code' => 'PK', 
                'name' => 'Pakistan'
            ],
            [
                'id' => '179', 
                'country_code' => 'PL', 
                'name' => 'Poland'
            ],
            [
                'id' => '180', 
                'country_code' => 'PM', 
                'name' => 'Saint Pierre and Miquelon'
            ],
            [
                'id' => '181', 
                'country_code' => 'PN', 
                'name' => 'Pitcairn Islands'
            ],
            [
                'id' => '182', 
                'country_code' => 'PR', 
                'name' => 'Puerto Rico'
            ],
            [
                'id' => '183', 
                'country_code' => 'PS', 
                'name' => 'Palestine'
            ],
            [
                'id' => '184', 
                'country_code' => 'PT', 
                'name' => 'Portugal'
            ],
            [
                'id' => '185', 
                'country_code' => 'PW', 
                'name' => 'Palau'
            ],
            [
                'id' => '186', 
                'country_code' => 'PY', 
                'name' => 'Paraguay'
            ],
            [
                'id' => '187', 
                'country_code' => 'QA', 
                'name' => 'Qatar'
            ],
            [
                'id' => '188', 
                'country_code' => 'RE', 
                'name' => 'Réunion'
            ],
            [
                'id' => '189', 
                'country_code' => 'RO', 
                'name' => 'Romania'
            ],
            [
                'id' => '190', 
                'country_code' => 'RS', 
                'name' => 'Serbia'
            ],
            [
                'id' => '191', 
                'country_code' => 'RU', 
                'name' => 'Russia'
            ],
            [
                'id' => '192', 
                'country_code' => 'RW', 
                'name' => 'Rwanda'
            ],
            [
                'id' => '193', 
                'country_code' => 'SA', 
                'name' => 'Saudi Arabia'
            ],
            [
                'id' => '194', 
                'country_code' => 'SB', 
                'name' => 'Solomon Islands'
            ],
            [
                'id' => '195', 
                'country_code' => 'SC', 
                'name' => 'Seychelles'
            ],
            [
                'id' => '196', 
                'country_code' => 'SD', 
                'name' => 'Sudan'
            ],
            [
                'id' => '197', 
                'country_code' => 'SE', 
                'name' => 'Sweden'
            ],
            [
                'id' => '198', 
                'country_code' => 'SG', 
                'name' => 'Singapore'
            ],
            [
                'id' => '199', 
                'country_code' => 'SH', 
                'name' => 'Saint Helena'
            ],
            [
                'id' => '200', 
                'country_code' => 'SI', 
                'name' => 'Slovenia'
            ],
            [
                'id' => '201', 
                'country_code' => 'SJ', 
                'name' => 'Svalbard and Jan Mayen'
            ],
            [
                'id' => '202', 
                'country_code' => 'SK', 
                'name' => 'Slovakia'
            ],
            [
                'id' => '203', 
                'country_code' => 'SL', 
                'name' => 'Sierra Leone'
            ],
            [
                'id' => '204', 
                'country_code' => 'SM', 
                'name' => 'San Marino'
            ],
            [
                'id' => '205', 
                'country_code' => 'SN', 
                'name' => 'Senegal'
            ],
            [
                'id' => '206', 
                'country_code' => 'SO', 
                'name' => 'Somalia'
            ],
            [
                'id' => '207', 
                'country_code' => 'SR', 
                'name' => 'Suriname'
            ],
            [
                'id' => '208', 
                'country_code' => 'SS', 
                'name' => 'South Sudan'
            ],
            [
                'id' => '209', 
                'country_code' => 'ST', 
                'name' => 'São Tomé and Príncipe'
            ],
            [
                'id' => '210', 
                'country_code' => 'SV', 
                'name' => 'El Salvador'
            ],
            [
                'id' => '211', 
                'country_code' => 'SX', 
                'name' => 'Sint Maarten'
            ],
            [
                'id' => '212', 
                'country_code' => 'SY', 
                'name' => 'Syria'
            ],
            [
                'id' => '213', 
                'country_code' => 'SZ', 
                'name' => 'Swaziland'
            ],
            [
                'id' => '214', 
                'country_code' => 'TC', 
                'name' => 'Turks and Caicos Islands'
            ],
            [
                'id' => '215', 
                'country_code' => 'TD', 
                'name' => 'Chad'
            ],
            [
                'id' => '216', 
                'country_code' => 'TF', 
                'name' => 'French Southern Territories'
            ],
            [
                'id' => '217', 
                'country_code' => 'TG', 
                'name' => 'Togo'
            ],
            [
                'id' => '218', 
                'country_code' => 'TH', 
                'name' => 'Thailand'
            ],
            [
                'id' => '219', 
                'country_code' => 'TJ', 
                'name' => 'Tajikistan'
            ],
            [
                'id' => '220', 
                'country_code' => 'TK', 
                'name' => 'Tokelau'
            ],
            [
                'id' => '221', 
                'country_code' => 'TL', 
                'name' => 'East Timor'
            ],
            [
                'id' => '222', 
                'country_code' => 'TM', 
                'name' => 'Turkmenistan'
            ],
            [
                'id' => '223', 
                'country_code' => 'TN', 
                'name' => 'Tunisia'
            ],
            [
                'id' => '224', 
                'country_code' => 'TO', 
                'name' => 'Tonga'
            ],
            [
                'id' => '225', 
                'country_code' => 'TR', 
                'name' => 'Turkey'
            ],
            [
                'id' => '226', 
                'country_code' => 'TT', 
                'name' => 'Trinidad and Tobago'
            ],
            [
                'id' => '227', 
                'country_code' => 'TV', 
                'name' => 'Tuvalu'
            ],
            [
                'id' => '228', 
                'country_code' => 'TW', 
                'name' => 'Taiwan'
            ],
            [
                'id' => '229', 
                'country_code' => 'TZ', 
                'name' => 'Tanzania'
            ],
            [
                'id' => '230', 
                'country_code' => 'UA', 
                'name' => 'Ukraine'
            ],
            [
                'id' => '231', 
                'country_code' => 'UG', 
                'name' => 'Uganda'
            ],
            [
                'id' => '232', 
                'country_code' => 'UM', 
                'name' => 'U.S. Minor Outlying Islands'
            ],
            [
                'id' => '233', 
                'country_code' => 'US', 
                'name' => 'United States'
            ],
            [
                'id' => '234', 
                'country_code' => 'UY', 
                'name' => 'Uruguay'
            ],
            [
                'id' => '235', 
                'country_code' => 'UZ', 
                'name' => 'Uzbekistan'
            ],
            [
                'id' => '236', 
                'country_code' => 'VA', 
                'name' => 'Vatican City'
            ],
            [
                'id' => '237', 
                'country_code' => 'VC', 
                'name' => 'Saint Vincent and the Grenadines'
            ],
            [
                'id' => '238', 
                'country_code' => 'VE', 
                'name' => 'Venezuela'
            ],
            [
                'id' => '239', 
                'country_code' => 'VG', 
                'name' => 'British Virgin Islands'
            ],
            [
                'id' => '240', 
                'country_code' => 'VI', 
                'name' => 'U.S. Virgin Islands'
            ],
            [
                'id' => '241', 
                'country_code' => 'VN', 
                'name' => 'Vietnam'
            ],
            [
                'id' => '242', 
                'country_code' => 'VU', 
                'name' => 'Vanuatu'
            ],
            [
                'id' => '243', 
                'country_code' => 'WF', 
                'name' => 'Wallis and Futuna'
            ],
            [
                'id' => '244', 
                'country_code' => 'WS', 
                'name' => 'Samoa'
            ],
            [
                'id' => '245', 
                'country_code' => 'XK', 
                'name' => 'Kosovo'
            ],
            [
                'id' => '246', 
                'country_code' => 'YE', 
                'name' => 'Yemen'
            ],
            [
                'id' => '247', 
                'country_code' => 'YT', 
                'name' => 'Mayotte'
            ],
            [
                'id' => '248', 
                'country_code' => 'ZA', 
                'name' => 'South Africa'
            ],
            [
                'id' => '249', 
                'country_code' => 'ZM', 
                'name' => 'Zambia'
            ],
            [
                'id' => '250', 
                'country_code' => 'ZW', 
                'name' => 'Zimbabwe'
            ],              
        ];
  
        foreach ($countries as $key => $value) {
            Country::create($value);
        }
    }
}
