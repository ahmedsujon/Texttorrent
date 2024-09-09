<div>
    <main class="main_content_wrapper setting_content_wrapper">
        <!-- DCL Registration Section  -->
        <section class="dcl_regisgtration_wrapper account_border">
            <div class="account_title_area">
                <div class="d-flex align-items-center flex-wrap g-sm">
                    <button type="button" class="sidebar_open_btn" id="sidebarShowBtn">
                        <img src="{{ asset('assets/app/icons/back-double-arrow.svg') }}" alt="double arrow" />
                    </button>
                    <img src="{{ asset('assets/app/icons/log-out.svg') }}" alt="log out icon" class="user_icon" />
                    <h2>DCL Registration Section</h2>
                </div>
            </div>
            <div class="alert_message_area">
                <div class="icon">
                    <img src="{{ asset('assets/app/icons/alert-01.svg') }}" alt="alert icon" />
                </div>
                <p>
                    If you want to use your local long code to send bulk SMS, then it's
                    recommended you register your business/brand and campaign/use case
                    with our SMS gateway partners. Most major US carriers are now
                    requiring businesses to register with The Campaign Registry (TCR) in
                    order to use standard 10 digit local numbers to send bulk SMS.
                    Carriers' A2P 10DLC(10 digit long code) offerings provide better
                    delivery quality, higher speed, and lower filtering risk than long
                    code SMS of the past, using the same phone numbers. We can assist
                    with this process, just go to this 10DLC registration form to fill
                    in some details so we can get started.
                </p>
            </div>
            <ul class="nav nav-pills mt-24" id="pills-tab" role="tablist" wire:ignore>
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                        aria-selected="true">
                        Brand Registration
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile"
                        aria-selected="false">
                        Campaign Registration
                    </button>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div wire:ignore.self class="tab-pane fade show active" id="pills-home" role="tabpanel"
                    aria-labelledby="pills-home-tab" tabindex="0">
                    <div class="register_area">
                        <h4>Register your brand</h4>
                        <p>
                            A brand is the company or entity the end customer believes to be
                            sending the message. To register your brand, please provide
                            complete, accurate, and up-to-date information about your
                            company. This information tells mobile network operators who is
                            sending messages.
                        </p>
                    </div>
                    <form class="event_form_area" wire:submit.prevent='saveBrandData'>
                        <div class="register_group">
                            <h4>Company details</h4>
                            <div class="input_row">
                                <label for="company_name">Company Name</label>
                                <input type="text" wire:model.blur='company_name' placeholder="Type Company Name"
                                    class="input_field" />
                                @error('company_name')
                                    <p class="text-danger mb-1" style="font-size: 13px;">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="two_grid">
                                <div class="input_row">
                                    <label for="company_phone">Company phone number</label>
                                    <input type="number" wire:model.blur='company_phone'
                                        placeholder="Type Company Phone Number" class="input_field" />
                                    @error('company_phone')
                                        <p class="text-danger mb-1" style="font-size: 13px;">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="input_row">
                                    <label for="company_website">Company Website</label>
                                    <input type="company_website" wire:model.blur='company_website'
                                        placeholder="Type Company Website" class="input_field" />
                                    @error('company_website')
                                        <p class="text-danger mb-1" style="font-size: 13px;">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="two_grid">
                                <div class="input_row searchable_select">
                                    <div wire:ignore>
                                        <label for="industry">Industry</label>
                                        <select name="lang" wire:model.blur='industry' class="js-searchBox industry">
                                            <option value="">Select Vertical</option>
                                            <option value="AGRICULTURE">Agriculture</option>
                                            <option value="COMMUNICATION">Communication</option>
                                            <option value="CONSTRUCTION">Construction</option>
                                            <option value="EDUCATION">Education</option>
                                            <option value="ENERGY">Energy</option>
                                            <option value="ENTERTAINMENT">Entertainment</option>
                                            <option value="FINANCIAL">Financial</option>
                                            <option value="GAMBLING">Gambling</option>
                                            <option value="GOVERNMENT">Government</option>
                                            <option value="HEALTHCARE">Healthcare</option>
                                            <option value="HOSPITALITY">Hospitality</option>
                                            <option value="INSURANCE">Insurance</option>
                                            <option value="MANUFACTURING">Manufacturing</option>
                                            <option value="NGO">NGO</option>
                                            <option value="REAL_ESTATE">Real Estate</option>
                                            <option value="RETAIL">Retail</option>
                                            <option value="TECHNOLOGY">Technology</option>
                                        </select>
                                        <img src="{{ asset('assets/app/icons/arrow-down.svg') }}" alt="down arrow"
                                            class="down_arrow" />
                                    </div>
                                    @error('industry')
                                        <p class="text-danger mb-1" style="font-size: 13px;">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="input_row searchable_select">
                                    <div wire:ignore>
                                        <label for="organization_type">Organization type</label>
                                        <select name="lang" wire:model.blur='organization_type'
                                            class="js-searchBox organization_type">
                                            <option value="">Select Type</option>
                                            <option value="PUBLIC_PROFIT">
                                                Publicly Traded Company
                                            </option>
                                            <option value="PRIVATE_PROFIT">Private Company</option>
                                            <option value="NON_PROFIT">
                                                Charity/Non-Proft Organization
                                            </option>
                                        </select>
                                        <img src="{{ asset('assets/app/icons/arrow-down.svg') }}" alt="down arrow"
                                            class="down_arrow" />
                                    </div>
                                    @error('organization_type')
                                        <p class="text-danger mb-1" style="font-size: 13px;">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="two_grid">
                                <div class="input_row searchable_select">
                                    <div wire:ignore>
                                        <label for="country_of_registration">Country of registration</label>
                                        <select name="lang" wire:model.blur='country_of_registration'
                                            class="js-searchBox country_of_registration">
                                            <option value="Afghanistan">Afghanistan</option>
                                            <option value="Albania">Albania</option>
                                            <option value="Algeria">Algeria</option>
                                            <option value="American Samoa">American Samoa</option>
                                            <option value="Andorra">Andorra</option>
                                            <option value="Angola">Angola</option>
                                            <option value="Anguilla">Anguilla</option>
                                            <option value="Antarctica">Antarctica</option>
                                            <option value="Antigua and Barbuda">
                                                Antigua and Barbuda
                                            </option>
                                            <option value="Argentina">Argentina</option>
                                            <option value="Armenia">Armenia</option>
                                            <option value="Aruba">Aruba</option>
                                            <option value="Australia">Australia</option>
                                            <option value="Austria">Austria</option>
                                            <option value="Azerbaijan">Azerbaijan</option>
                                            <option value="Bahamas">Bahamas</option>
                                            <option value="Bahrain">Bahrain</option>
                                            <option value="Bangladesh">Bangladesh</option>
                                            <option value="Barbados">Barbados</option>
                                            <option value="Belarus">Belarus</option>
                                            <option value="Belgium">Belgium</option>
                                            <option value="Belize">Belize</option>
                                            <option value="Benin">Benin</option>
                                            <option value="Bermuda">Bermuda</option>
                                            <option value="Bhutan">Bhutan</option>
                                            <option value="Bolivia">Bolivia</option>
                                            <option value="Bosnia and Herzegovina">
                                                Bosnia and Herzegovina
                                            </option>
                                            <option value="Botswana">Botswana</option>
                                            <option value="Bouvet Island">Bouvet Island</option>
                                            <option value="Brazil">Brazil</option>
                                            <option value="British Indian Ocean Territory">
                                                British Indian Ocean Territory
                                            </option>
                                            <option value="Brunei Darussalam">
                                                Brunei Darussalam
                                            </option>
                                            <option value="Bulgaria">Bulgaria</option>
                                            <option value="Burkina Faso">Burkina Faso</option>
                                            <option value="Burundi">Burundi</option>
                                            <option value="Cambodia">Cambodia</option>
                                            <option value="Cameroon">Cameroon</option>
                                            <option value="Canada">Canada</option>
                                            <option value="Cape Verde">Cape Verde</option>
                                            <option value="Cayman Islands">Cayman Islands</option>
                                            <option value="Central African Republic">
                                                Central African Republic
                                            </option>
                                            <option value="Chad">Chad</option>
                                            <option value="Chile">Chile</option>
                                            <option value="China">China</option>
                                            <option value="Christmas Island">Christmas Island</option>
                                            <option value="Cocos Keeling Islands">
                                                Cocos Keeling Islands
                                            </option>
                                            <option value="Colombia">Colombia</option>
                                            <option value="Comoros">Comoros</option>
                                            <option value="Congo">Congo</option>
                                            <option value="Congo The Democratic Republic of The">
                                                Congo The Democratic Republic of The
                                            </option>
                                            <option value="Cook Islands">Cook Islands</option>
                                            <option value="Costa Rica">Costa Rica</option>
                                            <option value="Croatia">Croatia</option>
                                            <option value="Cuba">Cuba</option>
                                            <option value="Cyprus">Cyprus</option>
                                            <option value="Czech Republic">Czech Republic</option>
                                            <option value="Denmark">Denmark</option>
                                            <option value="Djibouti">Djibouti</option>
                                            <option value="Dominica">Dominica</option>
                                            <option value="Dominican Republic">
                                                Dominican Republic
                                            </option>
                                            <option value="Ecuador">Ecuador</option>
                                            <option value="Egypt">Egypt</option>
                                            <option value="El Salvador">El Salvador</option>
                                            <option value="Equatorial Guinea">
                                                Equatorial Guinea
                                            </option>
                                            <option value="Eritrea">Eritrea</option>
                                            <option value="Estonia">Estonia</option>
                                            <option value="Ethiopia">Ethiopia</option>
                                            <option value="Falkland Islands Malvinas">
                                                Falkland Islands Malvinas
                                            </option>
                                            <option value="Faroe Islands">Faroe Islands</option>
                                            <option value="Fiji">Fiji</option>
                                            <option value="Finland">Finland</option>
                                            <option value="France">France</option>
                                            <option value="French Guiana">French Guiana</option>
                                            <option value="French Polynesia">French Polynesia</option>
                                            <option value="French Southern Territories">
                                                French Southern Territories
                                            </option>
                                            <option value="Gabon">Gabon</option>
                                            <option value="Gambia">Gambia</option>
                                            <option value="Georgia">Georgia</option>
                                            <option value="Germany">Germany</option>
                                            <option value="Ghana">Ghana</option>
                                            <option value="Gibraltar">Gibraltar</option>
                                            <option value="Greece">Greece</option>
                                            <option value="Greenland">Greenland</option>
                                            <option value="Grenada">Grenada</option>
                                            <option value="Guadeloupe">Guadeloupe</option>
                                            <option value="Guam">Guam</option>
                                            <option value="Guatemala">Guatemala</option>
                                            <option value="Guernsey">Guernsey</option>
                                            <option value="Guinea">Guinea</option>
                                            <option value="Guinea-bissau">Guinea-bissau</option>
                                            <option value="Guyana">Guyana</option>
                                            <option value="Haiti">Haiti</option>
                                            <option value="Heard Island and Mcdonald Islands">
                                                Heard Island and Mcdonald Islands
                                            </option>
                                            <option value="Honduras">Honduras</option>
                                            <option value="Hong Kong">Hong Kong</option>
                                            <option value="Hungary">Hungary</option>
                                            <option value="Iceland">Iceland</option>
                                            <option value="India">India</option>
                                            <option value="Indonesia">Indonesia</option>
                                            <option value="Iran Islamic Republic of">
                                                Iran Islamic Republic of
                                            </option>
                                            <option value="Iraq">Iraq</option>
                                            <option value="Ireland">Ireland</option>
                                            <option value="Isle of Man">Isle of Man</option>
                                            <option value="Israel">Israel</option>
                                            <option value="Italy">Italy</option>
                                            <option value="Jamaica">Jamaica</option>
                                            <option value="Japan">Japan</option>
                                            <option value="Jersey">Jersey</option>
                                            <option value="Jordan">Jordan</option>
                                            <option value="Kazakhstan">Kazakhstan</option>
                                            <option value="Kenya">Kenya</option>
                                            <option value="Kiribati">Kiribati</option>
                                            <option value="Korea Republic of">
                                                Korea Republic of
                                            </option>
                                            <option value="Kuwait">Kuwait</option>
                                            <option value="Kyrgyzstan">Kyrgyzstan</option>
                                            <option value="Latvia">Latvia</option>
                                            <option value="Lebanon">Lebanon</option>
                                            <option value="Lesotho">Lesotho</option>
                                            <option value="Liberia">Liberia</option>
                                            <option value="Libyan Arab Jamahiriya">
                                                Libyan Arab Jamahiriya
                                            </option>
                                            <option value="Liechtenstein">Liechtenstein</option>
                                            <option value="Lithuania">Lithuania</option>
                                            <option value="Luxembourg">Luxembourg</option>
                                            <option value="Macao">Macao</option>
                                            <option value="Macedonia The Former Yugoslav Republic of">
                                                Macedonia The Former Yugoslav Republic of
                                            </option>
                                            <option value="Madagascar">Madagascar</option>
                                            <option value="Malawi">Malawi</option>
                                            <option value="Malaysia">Malaysia</option>
                                            <option value="Maldives">Maldives</option>
                                            <option value="Mali">Mali</option>
                                            <option value="Malta">Malta</option>
                                            <option value="Marshall Islands">Marshall Islands</option>
                                            <option value="Martinique">Martinique</option>
                                            <option value="Mauritania">Mauritania</option>
                                            <option value="Mauritius">Mauritius</option>
                                            <option value="Mayotte">Mayotte</option>
                                            <option value="Mexico">Mexico</option>
                                            <option value="Micronesi Federated States of">
                                                Micronesia Federated States of
                                            </option>
                                            <option value="Moldova Republic of">
                                                Moldova Republic of
                                            </option>
                                            <option value="Monaco">Monaco</option>
                                            <option value="Mongolia">Mongolia</option>
                                            <option value="Montenegro">Montenegro</option>
                                            <option value="Montserrat">Montserrat</option>
                                            <option value="Morocco">Morocco</option>
                                            <option value="Mozambique">Mozambique</option>
                                            <option value="Myanmar">Myanmar</option>
                                            <option value="Namibia">Namibia</option>
                                            <option value="Nauru">Nauru</option>
                                            <option value="Nepal">Nepal</option>
                                            <option value="Netherlands">Netherlands</option>
                                            <option value="Netherlands Antilles">
                                                Netherlands Antilles
                                            </option>
                                            <option value="New Caledonia">New Caledonia</option>
                                            <option value="New Zealand">New Zealand</option>
                                            <option value="Nicaragua">Nicaragua</option>
                                            <option value="Niger">Niger</option>
                                            <option value="Nigeria">Nigeria</option>
                                            <option value="Niue">Niue</option>
                                            <option value="Norfolk Island">Norfolk Island</option>
                                            <option value="Northern Mariana Islands">
                                                Northern Mariana Islands
                                            </option>
                                            <option value="Norway">Norway</option>
                                            <option value="Oman">Oman</option>
                                            <option value="Pakistan">Pakistan</option>
                                            <option value="Palau">Palau</option>
                                            <option value="Palestinian Territory Occupied">
                                                Palestinian Territory Occupied
                                            </option>
                                            <option value="Panama">Panama</option>
                                            <option value="Papua New Guinea">Papua New Guinea</option>
                                            <option value="Paraguay">Paraguay</option>
                                            <option value="Peru">Peru</option>
                                            <option value="Philippines">Philippines</option>
                                            <option value="Pitcairn">Pitcairn</option>
                                            <option value="Poland">Poland</option>
                                            <option value="Portugal">Portugal</option>
                                            <option value="Puerto Rico">Puerto Rico</option>
                                            <option value="Qatar">Qatar</option>
                                            <option value="Reunion">Reunion</option>
                                            <option value="Romania">Romania</option>
                                            <option value="Russian Federation">
                                                Russian Federation
                                            </option>
                                            <option value="Rwanda">Rwanda</option>
                                            <option value="Saint Helena">Saint Helena</option>
                                            <option value="Saint Kitts and Nevis">
                                                Saint Kitts and Nevis
                                            </option>
                                            <option value="Saint Lucia">Saint Lucia</option>
                                            <option value="Saint Pierre and Miquelon">
                                                Saint Pierre and Miquelon
                                            </option>
                                            <option value="Saint Vincent and The Grenadines">
                                                Saint Vincent and The Grenadines
                                            </option>
                                            <option value="Samoa">Samoa</option>
                                            <option value="San Marino">San Marino</option>
                                            <option value="Sao Tome and Principe">
                                                Sao Tome and Principe
                                            </option>
                                            <option value="Saudi Arabia">Saudi Arabia</option>
                                            <option value="Senegal">Senegal</option>
                                            <option value="Serbia">Serbia</option>
                                            <option value="Seychelles">Seychelles</option>
                                            <option value="Sierra Leone">Sierra Leone</option>
                                            <option value="Singapore">Singapore</option>
                                            <option value="Slovakia">Slovakia</option>
                                            <option value="Slovenia">Slovenia</option>
                                            <option value="Solomon Islands">Solomon Islands</option>
                                            <option value="Somalia">Somalia</option>
                                            <option value="South Africa">South Africa</option>
                                            <option value="South Georgia and The South Sandwich Islands">
                                                South Georgia and The South Sandwich Islands
                                            </option>
                                            <option value="Spain">Spain</option>
                                            <option value="Sri Lanka">Sri Lanka</option>
                                            <option value="Sudan">Sudan</option>
                                            <option value="Suriname">Suriname</option>
                                            <option value="Svalbard and Jan Mayen">
                                                Svalbard and Jan Mayen
                                            </option>
                                            <option value="Swaziland">Swaziland</option>
                                            <option value="Sweden">Sweden</option>
                                            <option value="Switzerland">Switzerland</option>
                                            <option value="Syrian Arab Republic">
                                                Syrian Arab Republic
                                            </option>
                                            <option value="Taiwan, Province of China">
                                                Taiwan, Province of China
                                            </option>
                                            <option value="Tajikistan">Tajikistan</option>
                                            <option value="Tanzania, United Republic of">
                                                Tanzania, United Republic of
                                            </option>
                                            <option value="Thailand">Thailand</option>
                                            <option value="Timor-leste">Timor-leste</option>
                                            <option value="Togo">Togo</option>
                                            <option value="Tokelau">Tokelau</option>
                                            <option value="Tonga">Tonga</option>
                                            <option value="Trinidad and Tobago">
                                                Trinidad and Tobago
                                            </option>
                                            <option value="Tunisia">Tunisia</option>
                                            <option value="Turkey">Turkey</option>
                                            <option value="Turkmenistan">Turkmenistan</option>
                                            <option value="Turks and Caicos Islands">
                                                Turks and Caicos Islands
                                            </option>
                                            <option value="Tuvalu">Tuvalu</option>
                                            <option value="Uganda">Uganda</option>
                                            <option value="Ukraine">Ukraine</option>
                                            <option value="United Arab Emirates">
                                                United Arab Emirates
                                            </option>
                                            <option value="United Kingdom">United Kingdom</option>
                                            <option value="United States">United States</option>
                                            <option value="United States Minor Outlying Islands">
                                                United States Minor Outlying Islands
                                            </option>
                                            <option value="Uruguay">Uruguay</option>
                                            <option value="Uzbekistan">Uzbekistan</option>
                                            <option value="Vanuatu">Vanuatu</option>
                                            <option value="Venezuela">Venezuela</option>
                                            <option value="Viet Nam">Viet Nam</option>
                                            <option value="Virgin Islands - British">
                                                Virgin Islands - British
                                            </option>
                                            <option value="Virgin Islands - U.S.">
                                                Virgin Islands - U.S.
                                            </option>
                                            <option value="Wallis and Futuna">
                                                Wallis and Futuna
                                            </option>
                                            <option value="Western Sahara">Western Sahara</option>
                                            <option value="Yemen">Yemen</option>
                                            <option value="Zambia">Zambia</option>
                                            <option value="Zimbabwe">Zimbabwe</option>
                                        </select>
                                        <img src="{{ asset('assets/app/icons/arrow-down.svg') }}" alt="down arrow"
                                            class="down_arrow" />
                                    </div>
                                    @error('country_of_registration')
                                        <p class="text-danger mb-1" style="font-size: 13px;">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="input_row">
                                    <label for="tax_number">Tax number/ID /EIN</label>
                                    <input type="text" wire:model='tax_number' placeholder="Type Tax Info"
                                        class="input_field" />
                                    @error('tax_number')
                                        <p class="text-danger mb-1" style="font-size: 13px;">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="input_row">
                                <div class="checkbox_area d-flex align-items-center flex-wrap mb-0">
                                    <div class="form-check">
                                        <input class="form-check-input" wire:model.blur="share_legal_doc"
                                            onchange="updateCheckboxValue(this)" type="checkbox" value="0"
                                            id="brandgAgree" @if ($share_legal_doc) checked @endif />
                                        <label class="form-check-label mb-0" for="brandgAgree">
                                            I agree to share the required legal documents for the
                                            Tax information when required by the Carriers.
                                        </label>
                                        @error('share_legal_doc')
                                            <p class="text-danger mb-1" style="font-size: 13px;">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="register_group">
                            <h4>Address</h4>
                            <div class="two_grid">
                                <div class="input_row">
                                    <label for="city">City</label>
                                    <input type="text" wire:model.blur='city' placeholder="Type City"
                                        class="input_field" />
                                    @error('city')
                                        <p class="text-danger mb-1" style="font-size: 13px;">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="input_row">
                                    <label for="street_address">Street Address</label>
                                    <input type="text" wire:model.blur='street_address'
                                        placeholder="Type Street Address" class="input_field" />
                                    @error('street_address')
                                        <p class="text-danger mb-1" style="font-size: 13px;">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="two_grid">
                                <div class="input_row">
                                    <label for="state">State</label>
                                    <input type="text" wire:model.blur='state' placeholder="Type State"
                                        class="input_field" />
                                    @error('state')
                                        <p class="text-danger mb-1" style="font-size: 13px;">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="input_row">
                                    <label for="postal_code">Postal code</label>
                                    <input type="text" wire:model.blur='postal_code'
                                        placeholder="Type Postal code" class="input_field" />
                                    @error('postal_code')
                                        <p class="text-danger mb-1" style="font-size: 13px;">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end mt-2">
                            <button type="submit" class="create_event_btn">
                                {!! loadingStateWithText('saveBrandData', 'Save') !!}
                            </button>
                        </div>
                    </form>
                </div>
                <div wire:ignore.self class="tab-pane fade" id="pills-profile" role="tabpanel"
                    aria-labelledby="pills-profile-tab" tabindex="0">
                    <form wire:submit.prevent='saveCampaignData' class="event_form_area">
                        <div class="register_group">
                            <h4>Company details</h4>
                            <div class="two_grid">
                                <div class="input_row">
                                    <label for="campaign_name">Campaign name</label>
                                    <input type="text" wire:model.blur='campaign_name'
                                        placeholder="Campaign name (add an alias for your campaign)"
                                        class="input_field" />
                                    @error('campaign_name')
                                        <p class="text-danger mb-1" style="font-size: 13px;">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="input_row searchable_select">
                                    <div wire:ignore>
                                        <label for="campaign_type">Campaign type</label>
                                        <select name="lang" wire:model.blur='campaign_type'
                                            class="js-searchBox campaign_type">
                                            <option value="">Select</option>
                                            <option value="Python">Python</option>
                                            <option value="Java">Java</option>
                                            <option value="Ruby">Ruby</option>
                                            <option value="C/C++">C/C++</option>
                                            <option value="C#">C#</option>
                                            <option value="JavaScript">JavaScript</option>
                                            <option value="PHP">PHP</option>
                                            <option value="Swift">Swift</option>
                                            <option value="Scala">Scala</option>
                                            <option value="R">R</option>
                                            <option value="Go">Go</option>
                                            <option value="VisualBasic.NET">VisualBasic.NET</option>
                                            <option value="Kotlin">Kotlin</option>
                                        </select>
                                        <img src="{{ asset('assets/app/icons/arrow-down.svg') }}" alt="down arrow"
                                            class="down_arrow" />
                                    </div>
                                    @error('campaign_type')
                                        <p class="text-danger mb-1" style="font-size: 13px;">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="input_row">
                                <label for="campaign_description">Campaign description</label>
                                <textarea rows="4" wire:model.blur='campaign_description' class="input_field"
                                    placeholder="Please tell us about your requirement in details"></textarea>
                                @error('campaign_description')
                                    <p class="text-danger mb-1" style="font-size: 13px;">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="input_row">
                                <label for="sample_message_one">Sample message 1</label>
                                <textarea wire:model.blur='sample_message_one' rows="4" class="input_field"
                                    placeholder="Type Sample message 1"></textarea>
                                @error('sample_message_one')
                                    <p class="text-danger mb-1" style="font-size: 13px;">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="input_row">
                                <label for="sample_message_two">Sample message 2</label>
                                <textarea wire:model.blur='sample_message_two' rows="4" class="input_field"
                                    placeholder="Type Sample message 2"></textarea>
                                @error('sample_message_two')
                                    <p class="text-danger mb-1" style="font-size: 13px;">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="register_group">
                            <h4>Campaign and Content Attributes</h4>
                            <div class="content_attributes_grid">
                                <h5>Subscriber Opt-in</h5>
                                <div class="check_area">
                                    <div class="form-check">
                                        <input class="form-check-input" wire:model.blur='opt_in' value="1"
                                            type="radio" name="permissionCheckbox1" id="permissionYesCheckbox11"
                                            checked />
                                        <label class="form-check-label" for="permissionYesCheckbox11">
                                            Yes
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" wire:model.blur='opt_in' value="0"
                                            type="radio" name="permissionCheckbox1" id="permissionYesCheckbox12" />
                                        <label class="form-check-label" for="permissionYesCheckbox12">
                                            No
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="content_attributes_grid">
                                <h5>Subscriber Opt-out</h5>
                                <div class="check_area">
                                    <div class="form-check">
                                        <input class="form-check-input" wire:model.blur='opt_out' value="1"
                                            type="radio" name="permissionCheckbox2" id="permissionYesCheckbox21"
                                            checked />
                                        <label class="form-check-label" for="permissionYesCheckbox21">
                                            Yes
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" wire:model.blur='opt_out' value="0"
                                            type="radio" name="permissionCheckbox2" id="permissionYesCheckbox22" />
                                        <label class="form-check-label" for="permissionYesCheckbox22">
                                            No
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="content_attributes_grid">
                                <h5>Direct Lending or Loan Arrangement</h5>
                                <div class="check_area">
                                    <div class="form-check">
                                        <input class="form-check-input" wire:model.blur='direct_lending'
                                            value="1" type="radio" name="permissionCheckbox3"
                                            id="permissionYesCheckbox31" checked />
                                        <label class="form-check-label" for="permissionYesCheckbox31">
                                            Yes
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" wire:model.blur='direct_lending'
                                            value="0" type="radio" name="permissionCheckbox3"
                                            id="permissionYesCheckbox32" />
                                        <label class="form-check-label" for="permissionYesCheckbox32">
                                            No
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="content_attributes_grid">
                                <h5>Embedded Link</h5>
                                <div class="check_area">
                                    <div class="form-check">
                                        <input class="form-check-input" wire:model.blur='embedded_link'
                                            value="1" type="radio" name="permissionCheckbox4"
                                            id="permissionYesCheckbox41" checked />
                                        <label class="form-check-label" for="permissionYesCheckbox41">
                                            Yes
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" wire:model.blur='embedded_link'
                                            value="0" type="radio" name="permissionCheckbox4"
                                            id="permissionYesCheckbox52" />
                                        <label class="form-check-label" for="permissionYesCheckbox42">
                                            No
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="content_attributes_grid">
                                <h5>Embedded Phone Number</h5>
                                <div class="check_area">
                                    <div class="form-check">
                                        <input class="form-check-input" wire:model.blur='embedded_phone'
                                            value="1" type="radio" name="permissionCheckbox6"
                                            id="permissionYesCheckbox61" />
                                        <label class="form-check-label" for="permissionYesCheckbox61">
                                            Yes
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" wire:model.blur='embedded_phone'
                                            value="0" type="radio" name="permissionCheckbox6"
                                            id="permissionYesCheckbox62" checked />
                                        <label class="form-check-label" for="permissionYesCheckbox62">
                                            No
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="content_attributes_grid">
                                <h5>Affiliate Marketing</h5>
                                <div class="check_area">
                                    <div class="form-check">
                                        <input class="form-check-input" wire:model.blur='affiliate_marketing'
                                            value="1" type="radio" name="permissionCheckbox7"
                                            id="permissionYesCheckbox71" />
                                        <label class="form-check-label" for="permissionYesCheckbox71">
                                            Yes
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" wire:model.blur='affiliate_marketing'
                                            value="0" type="radio" name="permissionCheckbox7"
                                            id="permissionYesCheckbox72" checked />
                                        <label class="form-check-label" for="permissionYesCheckbox72">
                                            No
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="content_attributes_grid">
                                <h5>Age-gated Content</h5>
                                <div class="check_area">
                                    <div class="form-check">
                                        <input class="form-check-input" wire:model.blur='age_gated_content'
                                            value="1" type="radio" name="permissionCheckbox8"
                                            id="permissionYesCheckbox81" />
                                        <label class="form-check-label" for="permissionYesCheckbox81">
                                            Yes
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" wire:model.blur='age_gated_content'
                                            value="0" type="radio" name="permissionCheckbox8"
                                            id="permissionYesCheckbox82" checked />
                                        <label class="form-check-label" for="permissionYesCheckbox82">
                                            No
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="input_row">
                                <label for="additional_recipients">Additional Recipients to Email on 10DLC Registration
                                    Updates</label>
                                <input type="text" wire:model.blur='additional_recipients'
                                    placeholder="Comma-seperated list of email address name @campany.com,name@personal.com"
                                    class="input_field" />
                                @error('additional_recipients')
                                    <p class="text-danger mb-1" style="font-size: 13px;">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="input_row">
                                <div class="checkbox_area d-flex align-items-center flex-wrap mb-0">
                                    <div class="form-check">
                                        <input class="form-check-input" wire:model.blur='terms_aggre' type="checkbox"
                                            value="0" id="additionalRecipients"
                                            onchange="additionalRecipientsValue(this)"
                                            @if ($terms_aggre) checked @endif id="fromPhone" />
                                        <label class="form-check-label mb-0" for="terms_aggre">
                                            I consent to have Texttorrent's SMS gateway partners
                                            register and vet my brand on my organization’s behalf. I
                                            understand that there will be a one-time fee of $44 and
                                            recurring fees per campaign of $30 per quarter for
                                            registration. This will be invoiced to you separately.
                                        </label>
                                        @error('terms_aggre')
                                            <p class="text-danger mb-1" style="font-size: 13px;">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end mt-2">
                            <button type="submit" class="create_event_btn">
                                {!! loadingStateWithText('saveCampaignData', 'Save') !!}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.industry').on('change', function() {
                @this.set('industry', this.value);
            });
            $('.organization_type').on('change', function() {
                @this.set('organization_type', this.value);
            });
            $('.country_of_registration').on('change', function() {
                @this.set('country_of_registration', this.value);
            });
            $('.campaign_type').on('change', function() {
                @this.set('campaign_type', this.value);
            });
        });
    </script>

    <script>
        function updateCheckboxValue(checkbox) {
            checkbox.value = checkbox.checked ? '1' : '0';
            Livewire.emit('input', checkbox.name, checkbox.value);
        }
    </script>
    <script>
        function additionalRecipientsValue(checkbox) {
            checkbox.value = checkbox.checked ? '1' : '0';
            Livewire.emit('input', checkbox.name, checkbox.value);
        }
    </script>
@endpush
