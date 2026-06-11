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

            <h1 id="terms-of-use">Terms of Use</h1>

            <p>eBook Stack target audience is United States persons over 13 years of age. Visitors who are
                minors should be accompanied by an adult, and some content may be unsuitable for some readers, of any
                age.</p>

            <p>Non-US persons are advised to check copyright laws of their country before accessing any eBooks or other
                content from eBook Stack. Some content may be copyrighted, or otherwise restricted, for use in
                other countries. eBook Stack offers no warranty or assurances about copyright status or freedom to
                access or use its materials outside of the United States.</p>

            <div class="contents">
                Contents
                <ol>
                    <li><a href="#trademark-license">Trademark License</a></li>
                    <li><a href="#website-terms-of-use">Website Terms of Use</a>
                        <ol class="inner_1">
                            <li><a href="#audience">Audience</a></li>
                            <li><a href="#deep-linking">Deep Linking</a></li>
                            <li><a href="#embedding-or-wrapping-our-site-or-contents">Embedding or Wrapping our Site or
                                    Contents</a></li>
                            <li><a href="#opds-feed">OPDS Feed</a></li>
                            <li><a href="#automated-blocks">Automated Blocks</a></li>
                        </ol>
                    </li>
                    <li><a href="#footnotes">Footnotes</a></li>
                </ol>
            </div>

            <h2 id="trademark-license">Trademark License</h2>
            <p>What you are allowed to do with our eBooks once you download them:
                See: <a href="#">the eBook Stack License</a> and the <a href="#">Permission How-To</a>.</p>

            <h2 id="website-terms-of-use">Website Terms of Use</h2>

            <h3 id="audience">Audience</h3>
            <p><strong>This website is intended for human users only.</strong> Any perceived use of automated tools to
                access this website will result in a temporary or permanent block of your IP address.</p>
            <ul>
                <li>If you want to <strong>download many books<sup><a href="#footnotes">[1]</a></sup></strong> manually
                    or using an automated download software, download them from one of our mirrors, not from the main
                    site. See the <a href="#">list of PG mirrors</a> and the <a href="#">roboting guidelines</a>.</li>
                <li>If you want a <strong>list of all our books</strong>, download and save the <a href="#">eBook Stack
                        index file</a> It can be opened with any
                    browser or word processor.</li>
                <li>If you want a <strong>machine-readable database</strong> of all our books, read the <a
                        href="#">Offline Catalogs and Feeds</a> page.</li>
                <li>If you are behind a proxy or VPN because you want anonymity or because of company or school policy,
                    you may be blocked because other users of the same address are misbehaving. Try turning the proxy or
                    VPN off.</li>
                <li>If you are using a commercial product that channels requests through a proxy (such as Amazon
                    Kindle), your address may be blocked due to too much use from that shared proxy address. Instead,
                    see our <a href="#">tablets, phones and eReaders how-to</a> for guidance on how to
                    download items to your own system, prior to transferring to the other device.</li>
            </ul>

            <h3 id="deep-linking">Deep Linking</h3>
            <p>When linking to a eBook Stack item, link to the main landing page such as
                www.ebookstack.com/ebooks/11. Do not link to specific files or anchors, such as
                http://www.ebookstack.com/files/11/11-h/11-h.htm. Technical measures (i.e., cookies, captchas and
                similar) are utilized to ensure that links come from the landing page or elsewhere within
                www.ebookstack.com. If you need to link to a specific file or passage, please make your own copy of that
                file and host it on your own server.
                This measure is a protection against possible renaming or reorganizing the back end file structure,
                which has happened several times over the years. We intend the landing page to be permanent.</p>

            <h3 id="embedding-or-wrapping-our-site-or-contents">Embedding or Wrapping our Site or Contents</h3>
            <p><strong>Applies mainly to website owners.</strong>
                We do not allow large-scale deep-linking to eBook files hosted on our servers. We reserve the right to
                take legal and technical measures against this.</p>

            <p>While the books we host are free, our server infrastructure and bandwidth is not. It is paid with money
                generously made available by our donors and partners. We will not tolerate mock eBook Stack front-ends
                that pocket advertising revenues
                while leaving the cost of actually serving the files to us.</p>

            <h3 id="opds-feed">OPDS Feed</h3>
            <p><strong>Applies to OPDS application developers.</strong>
                Every application that uses our OPDS feed must:</p>
            <ul>
                <li>Use a proper user-agent, like: <em>calibre/1.1.0 (+http://www.calibre.org)</em>. Always include a
                    contact address like a web page or email, so we can reach you. Applications without contact address
                    and application developers that do not respond to our inquiries will be blocked from using our OPDS
                    feed.</li>
                <li>Make no more requests to our servers than a user with a browser typically would make (eg. for every
                    search, request only one page of results, and automatically request the next page only if the users
                    scrolls to the bottom of the previous page). If your application makes lots of requests, your users
                    will be blocked at the IP level.
                    For high-volume OPDS applications consider downloading our <a href="#">catalog database</a> and
                    hosting your own OPDS feed.
                    If you have special needs, <a href="#">contact us</a>, don’t try to
                    `hack around´.</li>
            </ul>

            <h3 id="automated-blocks">Automated Blocks</h3>
            <p>Blocks to Internet addresses (IP addresses) are applied automatically based on the volume of traffic and
                related factors. Such blocks automatically expire after a few days.</p>

            <h2 id="footnotes">Footnotes</h2>
            <ul>
                <li><a href="#audience">↑ Many books: i.e., more than ~100 per day</a></li>
            </ul>


        </div>
    </div>

    <!-- ═══ FOOTER ═══════════════════════════════════════════════ -->
    @include('layouts.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>