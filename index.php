<!DOCTYPE html>
<html lang="en" class="no-js">
    <head>
        <meta charset="utf-8">
        <title>STEEM Caffeinated Peanut Butter</title>
        <meta name="viewport" content="width=900, height=device-height">
        <meta name="description" content="">
        <meta name="author" content="">

        <meta property="og:site_name" content="STEEM Caffeinated Peanut Butter" />
        <meta property="og:title" content="STEEM Caffeinated Peanut Butter" />
        <meta property="og:url" content="http://steempb.com" />
        <meta property="og:description" content="STEEM is caffeinated peanut butter. What else do we need to say?" />
        <meta property="og:image" content="http://steempb.com/assets/img/facebook_og.png" />


        <!-- Le styles -->
        <link href='http://fonts.googleapis.com/css?family=Ubuntu:400,700,400italic,700italic|Ubuntu+Condensed' rel='stylesheet' type='text/css'>
        <link href="/assets/css/bootstrap.css" rel="stylesheet">
        <link href="/assets/css/main.css" rel="stylesheet">

        <!-- Modernizr -->
        <script type="text/javascript" src="/assets/js/modernizr.min.js"></script>

        <!-- I'm way too lazy to fix nth child on my own -->
        <!--[if lt IE 9]>
            <script src="/assets/js/IE9.js"></script>
        <![endif]-->

        <!-- Fav and touch icons -->
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/assets/ico/apple-touch-icon-114-precomposed.png">
          <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/assets/ico/apple-touch-icon-72-precomposed.png">
                        <link rel="apple-touch-icon-precomposed" href="/assets/ico/apple-touch-icon-57-precomposed.png">
                                       <link rel="shortcut icon" href="/assets/ico/favicon.ico">
    </head>

    <body data-spy="scroll" data-target=".navbar" data-offset="50">
        
        <div id="shippingModal" class="modal hide fade">
            <div class="modal-header">
                <h3>Shipping Details</h3>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" id="shippingDetails">
                    <div class="control-group">
                        <label class="control-label" for="inputName">Recipient Name</label>
                        <div class="controls">
                            <input class="input-xlarge" type="text" id="inputName" required placeholder="Recipient Name">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="inputStreetLine1">Line 1</label>
                        <div class="controls">
                            <input class="input-xlarge" type="text" id="inputStreetLine1" required placeholder="Line1">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="inputStreetLine2">Line 2</label>
                        <div class="controls">
                            <input class="input-xlarge" type="text" id="inputStreetLine2" placeholder="Line2">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="inputCountry">Country</label>
                        <div class="controls">
                            <select id="inputCountry" required>
                                <option value="AF">Afghanistan</option>
                                <option value="AL">Albania</option>
                                <option value="DZ">Algeria</option>
                                <option value="AS">American Samoa</option>
                                <option value="AD">Andorra</option>
                                <option value="AO">Angola</option>
                                <option value="AI">Anguilla</option>
                                <option value="AG">Antigua/Barbuda</option>
                                <option value="AR">Argentina</option>
                                <option value="AM">Armenia</option>
                                <option value="AW">Aruba</option>
                                <option value="AU">Australia</option>
                                <option value="AT">Austria</option>
                                <option value="AZ">Azerbaijan</option>
                                <option value="BS">Bahamas</option>
                                <option value="BH">Bahrain</option>
                                <option value="BD">Bangladesh</option>
                                <option value="BB">Barbados</option>
                                <option value="BY">Belarus</option>
                                <option value="BE">Belgium</option>
                                <option value="BZ">Belize</option>
                                <option value="BJ">Benin</option>
                                <option value="BM">Bermuda</option>
                                <option value="BT">Bhutan</option>
                                <option value="BO">Bolivia</option>
                                <option value="BA">Bosnia-Herzegovina</option>
                                <option value="BW">Botswana</option>
                                <option value="BR">Brazil</option>
                                <option value="VG">British Virgin Islands</option>
                                <option value="BN">Brunei</option>
                                <option value="BG">Bulgaria</option>
                                <option value="BF">Burkina Faso</option>
                                <option value="BI">Burundi</option>
                                <option value="KH">Cambodia</option>
                                <option value="CM">Cameroon</option>
                                <option value="CA">Canada</option>
                                <option value="CV">Cape Verde</option>
                                <option value="BQ">Caribbean Netherlands</option>
                                <option value="KY">Cayman Islands</option>
                                <option value="TD">Chad</option>
                                <option value="CL">Chile</option>
                                <option value="CN">China</option>
                                <option value="CO">Colombia</option>
                                <option value="CG">Congo Brazzaville</option>
                                <option value="CD">Congo Democratic Rep. of</option>
                                <option value="CK">Cook Islands</option>
                                <option value="CR">Costa Rica</option>
                                <option value="HR">Croatia</option>
                                <option value="CW">Curacao</option>
                                <option value="CY">Cyprus</option>
                                <option value="CZ">Czech Republic</option>
                                <option value="DK">Denmark</option>
                                <option value="DJ">Djibouti</option>
                                <option value="DM">Dominica</option>
                                <option value="DO">Dominican Republic</option>
                                <option value="TL">East Timor</option>
                                <option value="EC">Ecuador</option>
                                <option value="EG">Egypt</option>
                                <option value="SV">El Salvador</option>
                                <option value="GQ">Equatorial Guinea</option>
                                <option value="ER">Eritrea</option>
                                <option value="EE">Estonia</option>
                                <option value="ET">Ethiopia</option>
                                <option value="FO">Faeroe Islands</option>
                                <option value="FJ">Fiji</option>
                                <option value="FI">Finland</option>
                                <option value="FR">France</option>
                                <option value="GF">French Guiana</option>
                                <option value="PF">French Polynesia</option>
                                <option value="GA">Gabon</option>
                                <option value="GM">Gambia</option>
                                <option value="GE">Georgia</option>
                                <option value="DE">Germany</option>
                                <option value="GH">Ghana</option>
                                <option value="GI">Gibraltar</option>
                                <option value="GR">Greece</option>
                                <option value="GL">Greenland</option>
                                <option value="GD">Grenada</option>
                                <option value="GP">Guadeloupe</option>
                                <option value="GU">Guam</option>
                                <option value="GT">Guatemala</option>
                                <option value="GN">Guinea</option>
                                <option value="GY">Guyana</option>
                                <option value="HT">Haiti</option>
                                <option value="HN">Honduras</option>
                                <option value="HK">Hong Kong</option>
                                <option value="HU">Hungary</option>
                                <option value="IS">Iceland</option>
                                <option value="IN">India</option>
                                <option value="ID">Indonesia</option>
                                <option value="IQ">Iraq</option>
                                <option value="IE">Ireland</option>
                                <option value="IL">Israel</option>
                                <option value="IT">Italy</option>
                                <option value="CI">Ivory Coast</option>
                                <option value="JM">Jamaica</option>
                                <option value="JP">Japan</option>
                                <option value="JO">Jordan</option>
                                <option value="KZ">Kazakhstan</option>
                                <option value="KE">Kenya</option>
                                <option value="KI">Kiribati</option>
                                <option value="KW">Kuwait</option>
                                <option value="KG">Kyrgyzstan</option>
                                <option value="LA">Laos</option>
                                <option value="LV">Latvia</option>
                                <option value="LB">Lebanon</option>
                                <option value="LS">Lesotho</option>
                                <option value="LR">Liberia</option>
                                <option value="LY">Libya</option>
                                <option value="LI">Liechtenstein</option>
                                <option value="LT">Lithuania</option>
                                <option value="LU">Luxembourg</option>
                                <option value="MO">Macau</option>
                                <option value="MK">Macedonia</option>
                                <option value="MG">Madagascar</option>
                                <option value="MW">Malawi</option>
                                <option value="MY">Malaysia</option>
                                <option value="MV">Maldives</option>
                                <option value="ML">Mali</option>
                                <option value="MT">Malta</option>
                                <option value="MH">Marshall Islands</option>
                                <option value="MQ">Martinique</option>
                                <option value="MR">Mauritania</option>
                                <option value="MU">Mauritius</option>
                                <option value="MX">Mexico</option>
                                <option value="FM">Micronesia</option>
                                <option value="MD">Moldova</option>
                                <option value="MC">Monaco</option>
                                <option value="MN">Mongolia</option>
                                <option value="ME">Montenegro</option>
                                <option value="MS">Montserrat</option>
                                <option value="MA">Morocco</option>
                                <option value="MZ">Mozambique</option>
                                <option value="NA">Namibia</option>
                                <option value="NR">Nauru</option>
                                <option value="NP">Nepal</option>
                                <option value="NL">Netherlands</option>
                                <option value="NC">New Caledonia</option>
                                <option value="NZ">New Zealand</option>
                                <option value="NI">Nicaragua</option>
                                <option value="NE">Niger</option>
                                <option value="NG">Nigeria</option>
                                <option value="NO">Norway</option>
                                <option value="NU">Nuie</option>
                                <option value="OM">Oman</option>
                                <option value="PK">Pakistan</option>
                                <option value="PW">Palau</option>
                                <option value="PS">Palestine Autonomous</option>
                                <option value="PA">Panama</option>
                                <option value="PG">Papua New Guinea</option>
                                <option value="PY">Paraguay</option>
                                <option value="PE">Peru</option>
                                <option value="PH">Philippines</option>
                                <option value="PL">Poland</option>
                                <option value="PT">Portugal</option>
                                <option value="PR">Puerto Rico</option>
                                <option value="QA">Qatar</option>
                                <option value="RE">Reunion</option>
                                <option value="RO">Romania</option>
                                <option value="RU">Russian Federation</option>
                                <option value="RW">Rwanda</option>
                                <option value="MF">Saint Martin</option>
                                <option value="MP">Saipan</option>
                                <option value="WS">Samoa</option>
                                <option value="SA">Saudi Arabia</option>
                                <option value="SN">Senegal</option>
                                <option value="RS">Serbia</option>
                                <option value="SC">Seychelles</option>
                                <option value="SG">Singapore</option>
                                <option value="SX">Sint Maarten</option>
                                <option value="SK">Slovak Republic</option>
                                <option value="SI">Slovenia</option>
                                <option value="SB">Solomon Islands</option>
                                <option value="ZA">South Africa</option>
                                <option value="KR">South Korea</option>
                                <option value="ES">Spain</option>
                                <option value="LK">Sri Lanka</option>
                                <option value="KN">St. Kitts/Nevis</option>
                                <option value="LC">St. Lucia</option>
                                <option value="VC">St. Vincent</option>
                                <option value="SR">Suriname</option>
                                <option value="SZ">Swaziland</option>
                                <option value="SE">Sweden</option>
                                <option value="CH">Switzerland</option>
                                <option value="SY">Syria</option>
                                <option value="TW">Taiwan</option>
                                <option value="TZ">Tanzania</option>
                                <option value="TH">Thailand</option>
                                <option value="TG">Togo</option>
                                <option value="TO">Tonga</option>
                                <option value="TT">Trinidad/Tobago</option>
                                <option value="TN">Tunisia</option>
                                <option value="TR">Turkey</option>
                                <option value="TM">Turkmenistan</option>
                                <option value="TC">Turks &amp; Caicos Islands</option>
                                <option value="TV">Tuvalu</option>
                                <option value="VI">U.S. Virgin Islands</option>
                                <option value="UG">Uganda</option>
                                <option value="UA">Ukraine</option>
                                <option value="AE">United Arab Emirates</option>
                                <option value="GB">United Kingdom</option>
                                <option value="US" selected="selected">United States</option>
                                <option value="UY">Uruguay</option>
                                <option value="UZ">Uzbekistan</option>
                                <option value="VU">Vanuatu</option>
                                <option value="VE">Venezuela</option>
                                <option value="VN">Vietnam</option>
                                <option value="WF">Wallis &amp; Futuna</option>
                                <option value="YE">Yemen</option>
                                <option value="ZM">Zambia</option>
                                <option value="ZW">Zimbabwe</option>
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="inputCity">City</label>
                        <div class="controls">
                            <input class="input-xlarge" type="text" id="inputCity" required placeholder="City">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="inputState">State/Province</label>
                        <div class="controls">
                            <input class="input-xlarge" type="text" id="inputState" required placeholder="State/Province">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="inputPostalCode">Postal Code</label>
                        <div class="controls">
                            <input class="input-xlarge" type="text" id="inputPostalCode" required placeholder="Postal Code">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="inputPhone">Phone Number</label>
                        <div class="controls">
                            <input class="input-xlarge" type="text" id="inputPhone" required placeholder="Phone Number">
                        </div>
                    </div>
                    <div id="shippingTotal"></div>
                    <button id="shippingCalc" class="btn steembtn steembtn-large steembtn-fixed"><strong>Calculate Shipping</strong></button>
                </form>
            </div>
            <div class="modal-footer">
                <a class="btn btn-cancel">Cancel</a>
                <a disabled class="btn btn-primary">Continue Checkout</a>
            </div>
        </div>

        <div id="header-home">
            <div class="container">
                <a href="http://steempb.com"><img id="logo" src="/assets/img/template/logo_big.png" /></a>
                <img id="sublogo" src="/assets/img/template/caffeinated_sublogo.png" />
            </div>
        </div>

        <div id="navbar" class="navbar navbar-fixed-top navbar-inverse">
            <div class="navbar-inner">
                <div class="container">
                    <ul class="nav">
                        <li><a class="brand" href="#header-home"><img src="/assets/img/template/logo_small.png" /></a></li>
                        <li><a href="#faq-border">FAQ</a></li>
                        <li><a href="/blog">Blog</a></li>
                        <li class="social"><a href="http://twitter.com/steempb" target="_blank"><img src="/assets/img/template/twitter.png" /></a></li>
                        <li class="social"><a href="http://facebook.com/steempb" target="_blank"><img src="/assets/img/template/facebook.png" /></a></li>
                        <li class="social"><a href="https://plus.google.com/106045698028303100415" target="_blank"><img src="/assets/img/template/gplus.png" /></a></li>
                        <li><a href="#letsgo-wrap" class="btn btn-small btn-warning steembtn steembtn-small">Get it now <i class="icon-play"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="sunburst"></div>
        <div id="jetguy-main"><img src="/assets/img/template/jetguy_full.png" /></div>
        <div id="cta-main">
            <img id="beta-title" src="/assets/img/template/available_now_flat.png" />
            <img id="cta-jar" src="/assets/img/template/cta-jar.png" />
            <p class="lead">
            <!--     <a href="#faq-border">Find out more</a> -->
                <a class="btn btn-large btn-warning steembtn steembtn-large" href="#letsgo-wrap">Get it now <i class="icon-play"></i></a>
            </p>
        </div>

        <div id="faq-border"></div>
        <div id="faq-wrap">
            <div id="faq-section">
                <div class="row">
                    <h1>What is STEEM?</h1>
                    <p>STEEM is caffeinated peanut butter. What else do we need to say? STEEM is designed to provide a consistent release of sustained energy, and the naturally slow digestion of peanut butter is the key to that. STEEM delivers protein, electrolytes, and caffeine, granting you hours of endurance and focus, and freeing you from distractions like hunger and fatigue.</p>
                    <h1>What's in this stuff?</h1>
                    <p>STEEM is made with natural peanut butter, and no artificial sweeteners. Oh, and as much caffeine as two cups of coffee, so stick with the normal serving suggestions for the best effect. Enjoy it however you would normally enjoy peanut butter: spread it on crackers, toast or fruit; re-acquaint yourself with the simple perfection of the peanut butter and jelly sandwich; or just jam a knife or a spoon or a finger into the jar and eat it like you do when no one’s looking. Yes you do. Yes, you <em>do</em>.</p>
                    <h1>Who is STEEM for?</h1>
                    <p>STEEM’s steady release of energy (without the jittery feeling) makes it perfect not only for athletes and active people, but also for normal life. How about never having to choose awful breakroom coffee because you don’t want to spend more on caffeine than you spend on your lunch? How about having enough energy to finish that backyard project in one day instead of putting it off for another weekend? How about when an all-night study session has suddenly become the morning of the test? How about never having to bring that damn percolator on camping trips just so you can avoid the crippling caffeine headache you’ll have by noon? How about not worrying about nodding off in meetings, or in class, or at the wheel? How about just having the energy to get going when you need it?</p>
                    <h1>One last thing…</h1>
                    <p><strong>DO NOT GIVE TO ANIMALS. EVER.</strong> A fun fact about caffeine is that a lot of domestic animals, like dogs and cats and birds, cannot digest caffeine properly and it can lead to SERIOUS health issues. So we know that your dog loves peanut butter and we know you think it’d be hilarious to get him all jacked up and crazy, BUT DON’T. SERIOUSLY. IT WOULD NOT BE HILARIOUS. <br />STEEM = PEOPLE FOOD.</p>
                </div>
                <div class="row" id="faq-cta-row">
                        <h1>It's time to get going!</h1><a class="btn btn-large btn-warning steembtn steembtn-large" href="#letsgo-wrap">Get it now <i class="icon-play"></i></a>
                </div>
            </div>
        </div>

        <div class="sunburst"></div>

        <div id="faq-border-bottom"></div>
        
        <div id="letsgo-wrap">
            <div id="jet-fleet">
                <div class="jetguy jetguy-medium"><img src="/assets/img/template/jetguy_medium.png" /></div>
                <div class="jetguy jetguy-medium"><img src="/assets/img/template/jetguy_medium.png" /></div>
                <div class="jetguy jetguy-full"><img src="/assets/img/template/jetguy_full.png" /></div>
                <div class="jetguy jetguy-small"><img src="/assets/img/template/jetguy_small.png" /></div>
                <div class="jetguy jetguy-full"><img src="/assets/img/template/jetguy_full.png" /></div>
                <div class="jetguy jetguy-small"><img src="/assets/img/template/jetguy_small.png" /></div>
                <div class="jetguy jetguy-medium"><img src="/assets/img/template/jetguy_medium.png" /></div>
            </div>

            <div id="letsgo">
                <h1>Let's get going!</h1>
                <div id="form-container">
                    
                    <img id="jarsCost" src="/assets/img/template/jar_widget_cost.png" />
                    <form class="form-horizontal" method="POST" id="jarWidget">
                        <input type="hidden" id="inputProduct" value="6c403910-6ce3-4d72-9509-9ff8302c975c" />
                        <div class="control-group">
                            <label class="control-label" for="inputEmail">Email</label>
                            <div class="controls">
                                <input class="input-xlarge" type="text" id="inputEmail" required placeholder="Email">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="inputQuantity">Quantity</label>
                            <div class="controls">
                                <input class="input-xlarge" type="text" id="inputQuantity" required placeholder="Quantity">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="inputTickets">Tickets<br /><small>Optional</small></label>
                            <div class="controls">
                                <textarea class="input-xlarge" rows="3" id="inputTickets" placeholder="Separate multiple tickets with commas"></textarea>
                            </div>
                        </div>
                        <button type="submit" data-paymentMethod="DOGE" class="btn steembtn steembtn-large steembtn-fixed"><strong>Checkout with Ðogecoin</strong></button>
                        <button type="submit" data-paymentMethod="PAYPAL" class="btn steembtn steembtn-large steembtn-fixed"><strong>Checkout with PayPal</strong></button>
                    </form>
                </div>
            </div>
        </div>

        <div id="footer-home">
            All content © STEEM Peanut Butter, Inc., all rights reserved | Contact us: <a href="mailto:steempb@steempb.com">steempb@steempb.com</a>
        </div id="footer-home">

        <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
        <script src="/assets/js/bootstrap.js"></script>
        <script type="text/javascript" src="/assets/js/retina.js"></script>
        <script type="text/javascript" src="/assets/js/konami.js"></script>
        <script type="text/javascript" src="/assets/js/jquery.easing.1.3.js"></script>
        <script type="text/javascript" src="/assets/js/page.js"></script>
        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
  
            ga('create', 'UA-36577111-1', 'steempb.com');
            ga('send', 'pageview');

        </script>
    </body>
</html>