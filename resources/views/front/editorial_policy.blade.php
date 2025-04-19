@extends('front/layouts.layout')
@section('content')
    <section>
        <div class="container py-4">
            <a class="text-decoration-none" href="/">
                <img src="{{ url('') }}/sdamember-template/img/logo/sda-member-logo.png" height="auto"
                    style="width: 65vw; max-width: 320px;" alt="">
            </a>
        </div>
    </section>

    <section>
        <div class="container py-4">
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <h1>Editorial Policy</h1>

            <p><strong>Introduction</strong><br>
                FactaBot is a news aggregation app that collects, rephrases, and presents news articles from publicly available sources. The content presented within the app is sourced from various reputable media outlets, and our goal is to provide users with a concise, easy-to-read format. This editorial policy outlines the scope of content provided by the app, our role as a content aggregator, and the responsibilities of users.
            </p>

            <p><strong>1. Content Aggregation and Presentation</strong><br>
                Our app serves solely as a platform for presenting publicly available news articles. We do not create, edit, or produce the content; instead, we collect and rephrase articles from external news sources to provide our users with summaries and highlights of current events. The app provides a simplified and concise version of news articles but does not alter the substance of the information presented.
            </p>

            <p><strong>2. No Editorial Control Over Content</strong><br>
                While we strive to ensure that the content presented in our app is accurate and relevant, we do not exercise editorial control over the original articles. The opinions, views, and factual accuracy of the content belong solely to the original publishers. We are not responsible for any errors, omissions, or inaccuracies in the content or for any consequences arising from reliance on this information.
            </p>

            <p><strong>3. No Endorsement of Content</strong><br>
                The inclusion of any third-party content in the app does not imply endorsement, support, or affiliation with the original content providers. Our app merely serves as a tool to present news summaries from various sources, and we are not responsible for the editorial policies, practices, or any legal issues associated with the original content creators.
            </p>

            <p><strong>4. User Responsibility</strong><br>
                Users are encouraged to verify the accuracy of any information presented in the app by consulting the original source material directly. We do not guarantee the timeliness, completeness, or accuracy of the content and are not liable for any reliance placed on the information provided.
            </p>

            <p><strong>5. No Legal Liability for Content</strong><br>
                FactaBot disclaims all liability for any legal issues related to the content provided through the app, including, but not limited to, defamation, copyright infringement, or violations of privacy. We do not accept responsibility for any actions that may arise from the use or dissemination of the content. By using the app, users agree that they are solely responsible for their interpretation and use of the content.
            </p>

            <p><strong>6. Copyright and Fair Use</strong><br>
                We respect the intellectual property rights of others and make every effort to ensure that all content presented within the app falls within the bounds of fair use. We do not claim ownership of the original content. However, we do not accept responsibility for any copyright disputes or claims arising from the content sourced from third-party providers.
            </p>

            <p><strong>7. Third-Party Links and Content</strong><br>
                The app may contain links to third-party websites or resources that are not under our control. We are not responsible for the availability, content, or practices of these third-party sites. Any interactions or transactions that occur on third-party websites are solely between the user and the third party, and we disclaim any liability related to such activities.
            </p>

            <p><strong>8. Changes to Content and Policy</strong><br>
                We reserve the right to modify, update, or remove content from the app at our discretion, without prior notice. Users are encouraged to review the app regularly for updates. We also reserve the right to amend this Editorial Policy, and such changes will be posted here. Continued use of the app constitutes acceptance of the revised policy.
            </p>

            <p><strong>9. User Feedback and Reporting</strong><br>
                If you believe any content in the app infringes your intellectual property rights or violates any laws, please contact us immediately at ricecottondev@gmail.com. We will review any concerns raised and take appropriate action as necessary.
            </p>

            <p><strong>10. Contact Us</strong><br>
                For any questions regarding this Editorial Policy, please contact us at ricecottondev@gmail.com.
            </p>

            <hr>

            <h3>Fictional Representation Disclaimer</h3>
            <p>
                All images, characters, and visual content displayed on this website or within the Factabot app—including any depictions of individuals or team members—are entirely fictional and created for illustrative, satirical, or editorial purposes. Any resemblance to real persons, living or dead, is purely coincidental.
            </p>
            <p>
                Factabot does not use real photographs of staff or contributors in its marketing or in-app content. Visuals are AI-generated, stylized, or symbolic representations designed to reflect tone and brand personality—not actual identities.
            </p>
            <p>
                By using this site or app, you acknowledge that these materials are fictional and waive any claim or assumption to the contrary.
            </p>

        </div>
    </section>

    {{-- this loading spinner --}}
    <div class="collapse backdrop-spinner" id="loading">
        <div class="position-fixed start-0 top-0 end-0 bottom-0 w-100 h-100 d-flex justify-content-center align-items-center flex-column text-light fs-4"
            style="background-color: rgba(0,0,0,.5); z-index: 3000;">
            <div class="spinner-border" role="status"></div>
            <span class="p-3">Loading...Please Wait</span>
        </div>
    </div>
@endsection
