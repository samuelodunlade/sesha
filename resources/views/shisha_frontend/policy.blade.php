@extends("layouts.shisha")

@section("hero_section")
    <h1> Our Policies  </h1>
@endsection


@section("content")
<div class="row">
    <!-- main -->
    <div class="col-md-8">
        <h3>Effective Date: 10th October, 2025</h3>
        <p>
          Sesha (“we”, “us”, or “our”) is committed to protecting the privacy of our users. This Privacy Policy explains how we collect, use, and protect information when you use our anonymous secret sharing platform (the “Platform”).
        </p>
        <ol>
            <li>
                <h5>Information We Collect</h5>
                <p>
                    We intentionally minimize the data we collect. However, to maintain the safety and integrity of the platform, we may collect the following:
                </p>
                <p><strong>IP ADDRESS: </strong> We automatically collect and temporarily store users’ IP addresses to:</p>
                <ol type="a">
                    <li>Prevent spam, abuse, or harmful activity</li>
                    <li>Detect and limit over-posting or manipulation of votes</li>
                    <li>
                        Enforce moderation rules and community standards
                    </li>

                </ol>
                <p> 
                    We do not use IP addresses to personally identify users unless required by law or necessary for platform protection.
                </p>
            </li>

            <li>
                <h5>How We Use Your Information</h5>
                <p>
                    We use the information we collect solely to:
                </p>
               
                <ol type="a">
                    <li>Detect and prevent abuse or malicious activity</li>
                    <li>Monitor for excessive posting or voting</li>
                    <li>
                       Comply with legal obligations, if any arise
                    </li>

                </ol>
                <p> 
                    We do not sell, rent, or share your information with advertisers or third-party marketers.
                </p>
            </li>

            <li>
                <h5>Anonymous Usage</h5>
                <p>
                    Sesha does not require user accounts, email addresses, or names. You may use the platform completely anonymously, subject to the rules in our Terms and Conditions.
                </p>
                <p>
                    However, content you submit may be moderated, stored, or removed if it violates our terms.
                </p>
            </li>
          

            <li>
                <h5>Cookies and Tracking</h5>
                <p>
                   We may use minimal cookies or similar local storage to:
                </p>
               
                <ol type="a">
                    <li>Prevent duplicate votes on posts</li>
                    <li>Help manage user sessions or limit spam</li>
                </ol>
                <p> 
                    These cookies do not contain personal information and are not used for tracking users across other websites.
                </p>
            </li>

            <li>
                <h5>Data Retention</h5>
                <p>
                    IP logs and related metadata are stored only as long as necessary to detect abuse and enforce platform limits, after which they are automatically deleted.
                </p>
                <p>
                    Content shared on the Platform may be stored indefinitely unless it is removed by the user (if permitted) or by our moderation team.
                </p>
            </li>

            <li>
                <h5> Security Measures</h5>
                <p>
                    We use reasonable administrative and technical measures to protect the platform from misuse, hacking, or unauthorized access. However, no platform can guarantee absolute security.
                </p>
            </li>

            <li>
                <h5>Sharing of Information</h5>
                <p>
                  We may share information only when required by:
                </p>
               
                <ul type="a">
                    <li>Law enforcement agencies or court orders</li>
                    <li>Legal obligations or proceedings</li>
                    <li> Necessary platform protection (e.g., blocking IPs to stop repeated abuse) </li>
                </ul>
                <p> 
                    These cookies do not contain personal information and are not used for tracking users across other websites.
                </p>
            </li>

            <li>
                <h5> Children’s Privacy </h5>
                <p>
                  Sesha is <em> not intended for use by children under 13.</em> We do not knowingly collect any data from children. If we discover that a child has submitted content or data, we will remove it immediately.
                </p>
            </li>

            <li>
                <h5>  Your Rights </h5>
                <p>
                 Since Sesha collects minimal data, there are limited user-specific rights. However, if you believe your IP or content has been wrongfully flagged or restricted, you may contact us to appeal or inquire.
                </p>
            </li>

            <li>
                <h5>   Changes to this Privacy Policy </h5>
                <p>
                We may update this Privacy Policy periodically. The “Effective Date” at the top indicates the most recent changes. Continued use of the Platform after updates implies your acceptance.
                </p>
            </li>







        </ol>
           

    </div>
        <!-- sidebar -->
    <div class="col-md-4">
            <div class="row">
                <div class="col text-center  mb-4 pt-3">
                    <h4>  Shi Category </h4>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <x-category/>
                </div>
            </div>
            <div class="row">
                <div class="col text-center   mb-4 pt-3">
                    <h4> Popular  Secrets </h4>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="shi-cat-box">
                        <x-popular-secrets />
                    </div>
                </div>
            </div>
        </div>

</div>
@endsection