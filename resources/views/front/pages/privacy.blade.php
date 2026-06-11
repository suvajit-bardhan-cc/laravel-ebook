<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Book View - eBook Stack</title>

    <link rel="shortcut icon" href="images/1731092903.jpg" type="image/png">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <style>
        .btn-logout {
    appearance: none;
    -webkit-appearance: none;
    background: none;
    border: none;
    outline: none;
    padding: 0;
    margin: 0;
    font: inherit;
    color: inherit;
    cursor: pointer;
    text-decoration: none;
}
    </style>

</head>

<body>

    <!-- ═══ HEADER ══════════════════════════════════════════════ -->
    @include('layouts.header')
    <!-- ═══ PAGE BODY ════════════════════════════════════════════ -->
    <div class="page-wrap">
        <div class="page_content">

            <h1 id="privacy-policy">Privacy Policy</h1>

            <p>When you use the eBook Stack website, no personally identifiable information is collected about you
                except
                for
                the
                IP address from which you accessed the website. eBook Stack does NOT use third-party data collection
                tools
                such as Google Analytics, and does NOT allow web trackers of any kind.</p>

            <p>eBook Stack processes data from its access logs, including your IP address, for periodic analysis of
                website usage, quality assurance, and <a href="#">aggregate reporting</a>. All
                access log data, <em>including</em> your IP address, are <em>automatically</em> and <em>permanently</em>
                deleted
                after 60 days.</p>

            <p>All requests for data addition, correction, or deletion should be sent by email to <a
                    href="mailto:support@tryebookstack.com">support@tryebookstack.com</a>
            </p>

            <h2 id="uses-of-cookies-and-captchas">Uses of Cookies and Captchas</h2>
            <p>In order to assure the site is available for human users, not robots or third-party sites, this site may
                make
                use
                of cookies, captchas, and related techniques to apply our <a href="#">Terms of Use</a>.
                See these Terms of Use for alternate means to acquire eBook Stack content and metadata (i.e.,
                mirrors,
                offline catalogs, and OPDS) for automate use of eBook Stack content and metadata.</p>

            <h2 id="contributors">Contributors</h2>
            <p>Content contributed to eBook Stack, including errata reports and fixes, must be dedicated in the
                Public
                Domain. Dedications to the Public Domain may not be revoked.</p>

            <h2 id="links-to-third-party-websites">Links to Third Party Websites</h2>
            <p>The Project Gutenbeg website has links to external sites that it does not control and has no relationship
                to.
                Some of those sites, such as Facebook, are notorious wholesale collectors of private data, and it has
                been
                reported that such data are freely shared with national spy organizations and others. We strive to link
                in a
                manner that does not allow those third party websites to see what you are doing on eBook Stack
                unless
                you
                explicitly select one of those links. When you select a third party link, you will leave the Project
                eBook Stack
                website, and we cannot tell you what the other site will do with your data.</p>

        </div>
    </div>

    <!-- ═══ FOOTER ═══════════════════════════════════════════════ -->
    @include('layouts.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>