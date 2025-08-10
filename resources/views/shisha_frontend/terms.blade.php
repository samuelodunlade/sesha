@extends("layouts.shisha")

@section("hero_section")
    <h1> Terms and Conditions  </h1>
@endsection


@section("content")
<div class="row">
    <!-- main -->
    <div class="col-md-8">
        <h3>Effective Date: 10th October, 2025</h3>
        <p>
            Welcome to Sesha, a secret sharing platform. These Terms and Conditions  govern your use of our  secret sharing platform. By accessing or submitting content to the Platform, you agree to be bound by these Terms. If you do not agree, do not use the Platform.
        </p>
        <ol>
            <li>
                <h5>Nature of the Platform</h5>
                <p>
                    Sesha is a public forum that allows users to share anonymous messages or "secrets" without requiring authentication. The platform is intended for open expression, entertainment, and emotional release, not for harm, abuse, or targeting others.
                </p>
            </li>
            <li>
                <h5>Prohibited Content</h5>
                <p>
                    You must not submit, post, or share any content that:
                </p>
                <ul>
                    <li>
                        Includes the full name, real name, or contact details of any individual.
                    </li>
                    <li>
                        Provides a description or set of facts that can reasonably identify any person.
                    </li>
                    <li>
                        Accuses or implies illegal or immoral conduct by any identifiable individual or entity.
                    </li>
                    <li>
                        Contains hate speech, threats, abuse, or harassment of any kind.
                    </li>
                    <li>
                        Infringes on intellectual property rights, privacy rights, or publicity rights of others.
                    </li>
                    <li>
                        Violates any applicable law, regulation, or court order.
                    </li>
                </ul>
                <p>
                    <strong>
                        We reserve the right to remove any content that violates these rules, and may report such content to relevant authorities if necessary.
                    </strong>
                </p>
            </li>

            <li>
                <h5>User Responsibility</h5>
                <p>
                   By using this Platform, you acknowledge and agree that:
                </p>
                <ul>
                    <li>
                        You are solely responsible for the content you submit.
                    </li>
                    <li>
                        You will not use the Platform to defame, harass, abuse, or harm any individual or group.
                    </li>
                    <li>
                        You will not attempt to impersonate any individual or misrepresent your affiliation with any person or entity.
                    </li>
                    <li>
                        You understand that your submissions are permanently stored and may be reviewed, moderated, or deleted at our discretion.
                    </li>
                </ul>
            </li>

            <li>
                <h5> Disclaimer of Liability</h5>
                <p>
                    The content submitted by users does not represent the views of <em>Sesha</em>, its owners, or its administrators. We do not endorse or guarantee the accuracy, integrity, or quality of user-submitted content.
                </p>
                <p>
                    <strong> We are not liable</strong> for any loss, harm, or damage—direct or indirect—that may arise from content submitted to or published on the Platform.
                </p>
            </li>

            <li>
                <h5>Moderation and Content Removal</h5>
                <p>
                  We reserve the right, without notice or explanation, to:
                </p>
                <ul>
                    <li>
                        Review, edit, or remove any content at our sole discretion.
                    </li>
                    <li>
                        Ban or restrict users who repeatedly violate these Terms.
                    </li>
                    <li>
                       Comply with any lawful request or legal obligation, including court orders.
                    </li>

                </ul>
            </li>

            <li>
                <h5>
                    Intellectual Property
                </h5>
                <p>By submitting content, you grant us a non-exclusive, royalty-free, worldwide license to use, store, reproduce, and display the content solely for the operation and promotion of the Platform. You retain all ownership rights to your content.</p>
            </li>

            <li>
                <h5>
                    Privacy
                </h5>
                <p>
                   We do not collect personally identifiable information unless you explicitly provide it. However, technical metadata such as IP addresses may be logged for abuse prevention and legal compliance.
                    Please see our  <a href="{{ route('shisha.policy') }}">Privacy Policy</a>   for full details.
                </p>
            </li>

            <li>
                <h5>
                    Indemnity
                </h5>
                <p>
                   We do not collect personally identifiable information unless you explicitly provide it. However, technical You agree to indemnify and hold harmless Sesha, its owners, partners, employees, and agents from any claim, liability, damage, or cost (including legal fees) arising from your use of the Platform or any violation of these Terms.
                </p>
            </li>

            <li>
                <h5>
                   Changes to Terms
                </h5>
                <p>
                  We may update these Terms from time to time. When we do, we will revise the “Effective Date” above. Your continued use of the Platform constitutes acceptance of the updated Terms.
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