@extends('layouts.app')

@section('title', 'Privacy Policy - Indsoft24.com')

@section('content')
<div class="policy-page">
    <section class="policy-header">
        <div class="container">
            <h1 class="display-4 fw-bold">Privacy Policy</h1>
            <p class="lead text-muted">Your privacy is important to us. Here's how we handle your data.</p>
            <p class="text-muted"><small>Last Updated: {{ date('F d, Y') }}</small></p>
        </div>
    </section>

    <section class="policy-content py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="card p-4 p-md-5">
                        <p>Welcome to Indsoft24.com ("us", "we", or "our"). We operate the https://www.indsoft24.com website (the "Service"). This page informs you of our policies regarding the collection, use, and disclosure of personal data when you use our Service and the choices you have associated with that data.</p>

                        <h2 class="mt-2">1. Information Collection and Use</h2>
                        <p>We collect several different types of information for various purposes to provide and improve our Service to you.</p>

                        <h3>Types of Data Collected</h3>
                        <ul>
                            <li><strong>Personal Data:</strong> While using our Service, we may ask you to provide us with certain personally identifiable information that can be used to contact or identify you ("Personal Data"). This includes, but is not limited to:
                                <ul>
                                    <li>Email address (from newsletter subscriptions, contact forms, and Google Login)</li>
                                    <li>First name and last name (from Google Login)</li>
                                    <li>User-generated content, such as comments on our blog posts.</li>
                                </ul>
                            </li>
                            <li><strong>Usage Data:</strong> We may also collect information on how the Service is accessed and used ("Usage Data"). This Usage Data may include information such as your computer's Internet Protocol (IP) address, browser type, browser version, the pages of our Service that you visit, the time and date of your visit, the time spent on those pages, and other diagnostic data.</li>
                            <li><strong>Tracking & Cookies Data:</strong> We use cookies and similar tracking technologies to track the activity on our Service and hold certain information. You can instruct your browser to refuse all cookies or to indicate when a cookie is being sent.</li>
                        </ul>

                        <h2 class="mt-2">2. How We Use Your Information</h2>
                        <p>Indsoft24.com uses the collected data for various purposes:</p>
                        <ul>
                            <li>To provide and maintain our Service</li>
                            <li>To notify you about changes to our Service</li>
                            <li>To allow you to participate in interactive features of our Service, such as comments and likes, when you choose to do so</li>
                            <li>To respond to your inquiries via our contact form</li>
                            <li>To send you our newsletter, if you have subscribed</li>
                            <li>To monitor the usage of our Service to improve its performance and user experience</li>
                            <li>To detect, prevent and address technical issues</li>
                        </ul>

                        <h2 class="mt-2">3. Data Sharing and Disclosure</h2>
                        <p>We do not sell, trade, or rent your Personal Data to others. We may share generic aggregated demographic information not linked to any personal identification information with our business partners and trusted affiliates for the purposes outlined above. We may use third-party service providers to help us operate our business, such as sending out newsletters or analyzing site traffic (e.g., Google Analytics). We will only share your information with these third parties for those limited purposes provided that you have given us your permission.</p>

                        <h2 class="mt-2">4. Data Security</h2>
                        <p>The security of your data is important to us, but remember that no method of transmission over the Internet or method of electronic storage is 100% secure. While we strive to use commercially acceptable means to protect your Personal Data, we cannot guarantee its absolute security.</p>

                        <h2 class="mt-2">5. Your Data Protection Rights</h2>
                        <p>You have certain data protection rights. Indsoft24.com aims to take reasonable steps to allow you to correct, amend, delete, or limit the use of your Personal Data.</p>
                         <ul>
                            <li><strong>The right to access, update or delete the information we have on you.</strong></li>
                            <li><strong>The right of rectification.</strong> You have the right to have your information rectified if that information is inaccurate or incomplete.</li>
                            <li><strong>The right to object.</strong> You have the right to object to our processing of your Personal Data.</li>
                            <li><strong>The right to withdraw consent.</strong> You also have the right to withdraw your consent at any time where Indsoft24.com relied on your consent to process your personal information.</li>
                        </ul>
                        <p>To exercise these rights, please contact us.</p>

                        <h2 class="mt-2">6. Children's Privacy</h2>
                        <p>Our Service does not address anyone under the age of 13 ("Children"). We do not knowingly collect personally identifiable information from anyone under the age of 13. If you are a parent or guardian and you are aware that your Children has provided us with Personal Data, please contact us. If we become aware that we have collected Personal Data from children without verification of parental consent, we take steps to remove that information from our servers.</p>

                        <h2 class="mt-2">7. Changes to This Privacy Policy</h2>
                        <p>We may update our Privacy Policy from time to time. We will notify you of any changes by posting the new Privacy Policy on this page. You are advised to review this Privacy Policy periodically for any changes. Changes to this Privacy Policy are effective when they are posted on this page.</p>

                        <h2 class="mt-2">8. Contact Us</h2>
                        <p>If you have any questions about this Privacy Policy, please contact us by visiting the contact section on our homepage.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection