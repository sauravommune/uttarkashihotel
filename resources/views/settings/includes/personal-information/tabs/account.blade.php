<div class="tab-pane px-7" id="kt_user_edit_tab_2" role="tabpanel">
    <!--begin::Body-->
    <div class="card-body">
        <!--begin::Row-->
        <div class="row">
            <div class="col-xl-2"></div>
            <div class="col-xl-7">
                <div class="my-2">
                    <!--begin::Row-->
                    <div class="row">
                        <label class="col-form-label col-3 text-lg-right text-left"></label>
                        <div class="col-9">
                            <h6 class="text-dark font-weight-bold mb-10">
                                Account:</h6>
                        </div>
                    </div>
                    <!--end::Row-->
                    <!--begin::Group-->
                    <div class="form-group row">
                        <label class="col-form-label col-3 text-lg-right text-left">Email
                            Address</label>
                        <div class="col-9">
                            <div class="input-group input-group-lg input-group-solid">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="la la-at"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control form-control-lg form-control-solid"
                                    value="nick.watson@loop.com" placeholder="Email">
                            </div>
                            <span class="form-text text-muted">Emails can't
                                be changed.
                                <a href="#">Contact Support</a>.</span>
                        </div>
                    </div>
                    <!--end::Group-->
                    <!--begin::Group
                    <div class="form-group row">
                        <label
                            class="col-form-label col-3 text-lg-right text-left">Language</label>
                        <div class="col-9">
                            <select
                                class="form-control form-control-lg form-control-solid">
                                <option>Select Language...</option>
                                <option value="id">Bahasa Indonesia -
                                    Indonesian</option>
                                <option value="msa">Bahasa Melayu - Malay
                                </option>
                                <option value="ca">Català - Catalan</option>
                                <option value="cs">Čeština - Czech</option>
                                <option value="da">Dansk - Danish</option>
                                <option value="de">Deutsch - German</option>
                                <option value="en" selected="selected">
                                    English</option>
                                <option value="en-gb">English UK - British
                                    English</option>
                                <option value="es">Español - Spanish
                                </option>
                                <option value="eu">Euskara - Basque (beta)
                                </option>
                                <option value="fil">Filipino</option>
                                <option value="fr">Français - French
                                </option>
                                <option value="ga">Gaeilge - Irish (beta)
                                </option>
                                <option value="gl">Galego - Galician (beta)
                                </option>
                                <option value="hr">Hrvatski - Croatian
                                </option>
                                <option value="it">Italiano - Italian
                                </option>
                                <option value="hu">Magyar - Hungarian
                                </option>
                                <option value="nl">Nederlands - Dutch
                                </option>
                                <option value="no">Norsk - Norwegian
                                </option>
                                <option value="pl">Polski - Polish</option>
                                <option value="pt">Português - Portuguese
                                </option>
                                <option value="ro">Română - Romanian
                                </option>
                                <option value="sk">Slovenčina - Slovak
                                </option>
                                <option value="fi">Suomi - Finnish</option>
                                <option value="sv">Svenska - Swedish
                                </option>
                                <option value="vi">Tiếng Việt - Vietnamese
                                </option>
                                <option value="tr">Türkçe - Turkish</option>
                                <option value="el">Ελληνικά - Greek</option>
                                <option value="bg">Български език -
                                    Bulgarian</option>
                                <option value="ru">Русский - Russian
                                </option>
                                <option value="sr">Српски - Serbian</option>
                                <option value="uk">Українська мова -
                                    Ukrainian</option>
                                <option value="he">עִבְרִית - Hebrew
                                </option>
                                <option value="ur">اردو - Urdu (beta)
                                </option>
                                <option value="ar">العربية - Arabic</option>
                                <option value="fa">فارسی - Persian</option>
                                <option value="mr">मराठी - Marathi</option>
                                <option value="hi">हिन्दी - Hindi</option>
                                <option value="bn">বাংলা - Bangla</option>
                                <option value="gu">ગુજરાતી - Gujarati
                                </option>
                                <option value="ta">தமிழ் - Tamil</option>
                                <option value="kn">ಕನ್ನಡ - Kannada</option>
                                <option value="th">ภาษาไทย - Thai</option>
                                <option value="ko">한국어 - Korean</option>
                                <option value="ja">日本語 - Japanese</option>
                                <option value="zh-cn">简体中文 - Simplified
                                    Chinese</option>
                                <option value="zh-tw">繁體中文 - Traditional
                                    Chinese</option>
                            </select>
                        </div>
                    </div>
                    end::Group-->
                    <!--begin::Group-->
                    <div class="form-group row">
                        <label class="col-form-label col-3 text-lg-right text-left">Time
                            Zone</label>
                        <div class="col-9">
                            <select name="timezone" class="form-control form-control-lg form-control-solid">
                                @foreach(config('data.timezones') as $timezone)
                                <option value="{{$timezone['value']}}" @if($timezone['value']}}==Auth::user()->timezone)
                                    selected
                                    @endif
                                    >{{$timezone['text']}}</option>
                                @endforeach
                                <option value="Etc/GMT+12">(GMT-12:00) International Date Line West</option>
                                <option value="Pacific/Midway">(GMT-11:00) Midway Island, Samoa</option>
                                <option value="Pacific/Honolulu">(GMT-10:00) Hawaii</option>
                                <option value="US/Alaska">(GMT-09:00) Alaska</option>
                                <option value="America/Los_Angeles">(GMT-08:00) Pacific Time (US & Canada)</option>
                                <option value="America/Tijuana">(GMT-08:00) Tijuana, Baja California</option>
                                <option value="US/Arizona">(GMT-07:00) Arizona</option>
                                <option value="America/Chihuahua">(GMT-07:00) Chihuahua, La Paz, Mazatlan</option>
                                <option value="US/Mountain">(GMT-07:00) Mountain Time (US & Canada)</option>
                                <option value="America/Managua">(GMT-06:00) Central America</option>
                                <option value="US/Central">(GMT-06:00) Central Time (US & Canada)</option>
                                <option value="America/Mexico_City">(GMT-06:00) Guadalajara, Mexico City, Monterrey
                                </option>
                                <option value="Canada/Saskatchewan">(GMT-06:00) Saskatchewan</option>
                                <option value="America/Bogota">(GMT-05:00) Bogota, Lima, Quito, Rio Branco</option>
                                <option value="US/Eastern">(GMT-05:00) Eastern Time (US & Canada)</option>
                                <option value="US/East-Indiana">(GMT-05:00) Indiana (East)</option>
                                <option value="Canada/Atlantic">(GMT-04:00) Atlantic Time (Canada)</option>
                                <option value="America/Caracas">(GMT-04:00) Caracas, La Paz</option>
                                <option value="America/Manaus">(GMT-04:00) Manaus</option>
                                <option value="America/Santiago">(GMT-04:00) Santiago</option>
                                <option value="Canada/Newfoundland">(GMT-03:30) Newfoundland</option>
                                <option value="America/Sao_Paulo">(GMT-03:00) Brasilia</option>
                                <option value="America/Argentina/Buenos_Aires">(GMT-03:00) Buenos Aires, Georgetown
                                </option>
                                <option value="America/Godthab">(GMT-03:00) Greenland</option>
                                <option value="America/Montevideo">(GMT-03:00) Montevideo</option>
                                <option value="America/Noronha">(GMT-02:00) Mid-Atlantic</option>
                                <option value="Atlantic/Cape_Verde">(GMT-01:00) Cape Verde Is.</option>
                                <option value="Atlantic/Azores">(GMT-01:00) Azores</option>
                                <option value="Africa/Casablanca">(GMT+00:00) Casablanca, Monrovia, Reykjavik</option>
                                <option value="Etc/Greenwich">(GMT+00:00) Greenwich Mean Time : Dublin, Edinburgh,
                                    Lisbon, London</option>
                                <option value="Europe/Amsterdam">(GMT+01:00) Amsterdam, Berlin, Bern, Rome, Stockholm,
                                    Vienna</option>
                                <option value="Europe/Belgrade">(GMT+01:00) Belgrade, Bratislava, Budapest, Ljubljana,
                                    Prague</option>
                                <option value="Europe/Brussels">(GMT+01:00) Brussels, Copenhagen, Madrid, Paris</option>
                                <option value="Europe/Sarajevo">(GMT+01:00) Sarajevo, Skopje, Warsaw, Zagreb</option>
                                <option value="Africa/Lagos">(GMT+01:00) West Central Africa</option>
                                <option value="Asia/Amman">(GMT+02:00) Amman</option>
                                <option value="Europe/Athens">(GMT+02:00) Athens, Bucharest, Istanbul</option>
                                <option value="Asia/Beirut">(GMT+02:00) Beirut</option>
                                <option value="Africa/Cairo">(GMT+02:00) Cairo</option>
                                <option value="Africa/Harare">(GMT+02:00) Harare, Pretoria</option>
                                <option value="Europe/Helsinki">(GMT+02:00) Helsinki, Kyiv, Riga, Sofia, Tallinn,
                                    Vilnius</option>
                                <option value="Asia/Jerusalem">(GMT+02:00) Jerusalem</option>
                                <option value="Europe/Minsk">(GMT+02:00) Minsk</option>
                                <option value="Africa/Windhoek">(GMT+02:00) Windhoek</option>
                                <option value="Asia/Kuwait">(GMT+03:00) Kuwait, Riyadh, Baghdad</option>
                                <option value="Europe/Moscow">(GMT+03:00) Moscow, St. Petersburg, Volgograd</option>
                                <option value="Africa/Nairobi">(GMT+03:00) Nairobi</option>
                                <option value="Asia/Tbilisi">(GMT+03:00) Tbilisi</option>
                                <option value="Asia/Tehran">(GMT+03:30) Tehran</option>
                                <option value="Asia/Muscat">(GMT+04:00) Abu Dhabi, Muscat</option>
                                <option value="Asia/Baku">(GMT+04:00) Baku</option>
                                <option value="Asia/Yerevan">(GMT+04:00) Yerevan</option>
                                <option value="Asia/Kabul">(GMT+04:30) Kabul</option>
                                <option value="Asia/Yekaterinburg">(GMT+05:00) Yekaterinburg</option>
                                <option value="Asia/Karachi">(GMT+05:00) Islamabad, Karachi, Tashkent</option>
                                <option value="Asia/Calcutta">(GMT+05:30) Chennai, Kolkata, Mumbai, New Delhi</option>
                                <option value="Asia/Calcutta">(GMT+05:30) Sri Jayawardenapura</option>
                                <option value="Asia/Katmandu">(GMT+05:45) Kathmandu</option>
                                <option value="Asia/Almaty">(GMT+06:00) Almaty, Novosibirsk</option>
                                <option value="Asia/Dhaka">(GMT+06:00) Astana, Dhaka</option>
                                <option value="Asia/Rangoon">(GMT+06:30) Yangon (Rangoon)</option>
                                <option value="Asia/Bangkok">(GMT+07:00) Bangkok, Hanoi, Jakarta</option>
                                <option value="Asia/Krasnoyarsk">(GMT+07:00) Krasnoyarsk</option>
                                <option value="Asia/Hong_Kong">(GMT+08:00) Beijing, Chongqing, Hong Kong, Urumqi
                                </option>
                                <option value="Asia/Kuala_Lumpur">(GMT+08:00) Kuala Lumpur, Singapore</option>
                                <option value="Asia/Irkutsk">(GMT+08:00) Irkutsk, Ulaan Bataar</option>
                                <option value="Australia/Perth">(GMT+08:00) Perth</option>
                                <option value="Asia/Taipei">(GMT+08:00) Taipei</option>
                                <option value="Asia/Tokyo">(GMT+09:00) Osaka, Sapporo, Tokyo</option>
                                <option value="Asia/Seoul">(GMT+09:00) Seoul</option>
                                <option value="Asia/Yakutsk">(GMT+09:00) Yakutsk</option>
                                <option value="Australia/Adelaide">(GMT+09:30) Adelaide</option>
                                <option value="Australia/Darwin">(GMT+09:30) Darwin</option>
                                <option value="Australia/Brisbane">(GMT+10:00) Brisbane</option>
                                <option value="Australia/Canberra">(GMT+10:00) Canberra, Melbourne, Sydney</option>
                                <option value="Australia/Hobart">(GMT+10:00) Hobart</option>
                                <option value="Pacific/Guam">(GMT+10:00) Guam, Port Moresby</option>
                                <option value="Asia/Vladivostok">(GMT+10:00) Vladivostok</option>
                                <option value="Asia/Magadan">(GMT+11:00) Magadan, Solomon Is., New Caledonia</option>
                                <option value="Pacific/Auckland">(GMT+12:00) Auckland, Wellington</option>
                                <option value="Pacific/Fiji">(GMT+12:00) Fiji, Kamchatka, Marshall Is.</option>
                                <option value="Pacific/Tongatapu">(GMT+13:00) Nuku'alofa</option>
                            </select>

                        </div>
                    </div>
                    <!--end::Group-->
                </div>
            </div>
        </div>
        <!--end::Row-->
    </div>
    <!--begin::Footer-->
    <div class="card-footer pb-0">
        <div class="row">
            <div class="col-xl-2"></div>
            <div class="col-xl-7">
                <div class="row">
                    <div class="col-3"></div>
                    <div class="col-9">
                        <a href="javascript:;" class="btn btn-light-primary font-weight-bold">
                            Save Changes</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end::Footer-->
</div>