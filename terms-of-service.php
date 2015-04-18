<?php
session_start();
include_once $_SERVER['DOCUMENT_ROOT'] . '/controls/base_control.php';
?>
<!DOCTYPE html>
<html lang="he" xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="keywords" content="forms,forms generator,real free,free form,contact us
              ,contactus,terms,service,terms of service" />

        <meta name="description" 
              content="Terms of Service - For a real free contact form for your website with integrated anti-spam protection!
              ,get it now for free" />

        <title>Terms of Service - ITHD-Online</title>
        <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/views/parts/styling.php'; ?>
    </head>
    <body>
        <header>
            <?php
            include_once $_SERVER['DOCUMENT_ROOT'] . '/views/parts/google-analystics.php';

            if (isset($_SESSION[Base_Control::SESSION_ADMIN_EMAIL])) {
                include_once $_SERVER['DOCUMENT_ROOT'] . '/views/parts/top_menu.php';
            } else if (isset($_SESSION[Base_Control::SESSION_CUSTOMER_EMAIL])){
                include_once $_SERVER['DOCUMENT_ROOT'] . '/views/parts/top_menu_customer.php';
            } else {
                include_once $_SERVER['DOCUMENT_ROOT'] . '/views/parts/top_menu.php';
            }
            ?>
        </header>
        <article>
            <section id="terms">

                <h1>ITHD-Online Terms of Service</h1>
                <p>
                    Last modified: March. 24, 2015
                </p>

            </section>
            <section>

                <h2>Welcome to ITHD-Online!</h2>
                <p>
                    Thanks for using our products and services (“Services”). 
                    The Services are provided by I.L.N Software. Located at 6b H’Golan ST. Netanya, Israel. 
                    <br /><br />
                    By using our Services, you are agreeing to these terms. Please read them carefully. 
                    <br /><br />
                    Our Services are very diverse, so sometimes additional terms or product requirements 
                    (including age requirements) may apply. 
                    Additional terms will be available with the relevant Services, 
                    and those additional terms become part of your agreement with us if you use those Services.
                </p>
            </section>
            <section>

                <h2>Using our Services</h2>
                <p>
                    You must follow any policies made available to you within the Services.
                    <br /><br />
                    Don’t misuse our Services. For example, don’t interfere with our Services or 
                    try to access them using a method other than the interface and 
                    the instructions that we provide. 
                    You may use our Services only as permitted by law, including applicable export and 
                    re-export control laws and regulations. We may suspend or stop providing our 
                    Services to you if you do not comply with our terms or policies or if we 
                    are investigating suspected misconduct. 
                    <br /><br />
                    Using our Services does not give you ownership of any intellectual property rights in our Services 
                    or the content you access. You may not use content from our Services 
                    unless you obtain permission from its owner or are otherwise permitted by law. 
                    These terms do not grant you the right to use any branding or logos used in our Services. 
                    Don’t remove, obscure, or alter any legal notices displayed in or along with our Services. 
                    <br /><br />
                    In connection with your use of the Services, we may send you service announcements, 
                    administrative messages, and other information. You may opt out of some of those communications. 
                    <br /><br />
                    Some of our Services are available on mobile devices. Do not use such Services in a 
                    way that distracts you and prevents you from obeying traffic or safety laws.
                </p>
            </section>
            <section>
                <h2>Your Google Account</h2>
                <p>
                    You may need a Google Account in order to use some of our Services. 
                    You may create your own Google Account, or your Google Account may 
                    be assigned to you by an administrator, such as your employer or 
                    educational institution. If you are using a 
                    Google Account assigned to you by an administrator, 
                    different or additional terms may apply and your administrator may be able to access 
                    or disable your account. 
                    <br /><br />
                    To protect your Google Account, keep your password confidential. 
                    You are responsible for the activity 
                    that happens on or through your Google Account. 
                    Try not to reuse your Google Account password on third-party applications.
                    If you learn of any unauthorized use of your password or Google Account, 
                    <a target="_blank" href="http://support.google.com/accounts/bin/answer.py?hl=en&answer=58585">follow these instructions.</a>
                </p>
            </section>
            <section>
                <h2>About Software in our Services</h2>
                <p>
                    When a Service requires or includes downloadable software, 
                    this software may update automatically on your device once a new version or 
                    feature is available. Some Services may let you adjust your automatic update settings.
                    <br /><br />
                    I.L.N Software gives you a personal, worldwide, royalty-free, 
                    non-assignable and non-exclusive license to use the software provided to you by 
                    I.L.N Software as part of the Services. This license is for the sole purpose of 
                    enabling you to use and enjoy the benefit of the Services as provided by 
                    I.L.N Software, in the manner permitted by these terms. You may not copy, modify, 
                    distribute, sell, or lease any part of our Services or included software, 
                    nor may you reverse engineer or attempt to extract the source code of that software, 
                    unless laws prohibit those restrictions or you have our written permission.
                </p>
            </section>
            <section>
                <h2>Modifying and Terminating our Services</h2>
                <p>
                    We are constantly changing and improving our Services. 
                    We may add or remove functionalities or features, 
                    and we may suspend or stop a Service altogether. 
                    <br /><br />
                    You can stop using our Services at any time, although we’ll be sorry to see you go. 
                    I.L.N Software may also stop providing Services to you, or add or 
                    create new limits to our Services at any time.
                </p>
            </section>
            <section>
                <h2>Our Warranties and Disclaimers</h2>
                <p>
                    We provide our Services using a commercially reasonable level of skill and care and we 
                    hope that you will enjoy using them. 
                    But there are certain things that we don’t promise about our Services
                </br><br />
            OTHER THAN AS EXPRESSLY SET OUT IN THESE TERMS OR ADDITIONAL TERMS, 
            NEITHER I.L.N SOFTWARE NOR ITS SUPPLIERS OR DISTRIBUTORS MAKE ANY SPECIFIC 
            PROMISES ABOUT THE SERVICES. FOR EXAMPLE, WE DON’T MAKE ANY COMMITMENTS 
            ABOUT THE CONTENT WITHIN THE SERVICES, THE SPECIFIC FUNCTIONS OF THE SERVICES, 
            OR THEIR RELIABILITY, AVAILABILITY, OR ABILITY TO MEET YOUR NEEDS. WE PROVIDE 
            THE SERVICES “AS IS”. </br><br />
            SOME JURISDICTIONS PROVIDE FOR CERTAIN WARRANTIES, LIKE THE IMPLIED WARRANTY 
            OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NON-INFRINGEMENT. 
            TO THE EXTENT PERMITTED BY LAW, WE EXCLUDE ALL WARRANTIES.
        </p>
    </section>
    <section>
        <h2>Liability for our Services</h2>
        <p>
            WHEN PERMITTED BY LAW, I.L.N SOFTWARE WILL NOT BE RESPONSIBLE FOR LOST PROFITS, 
            REVENUES, OR DATA, FINANCIAL LOSSES OR INDIRECT, SPECIAL, CONSEQUENTIAL, 
            EXEMPLARY, OR PUNITIVE DAMAGES.
            <br /><br />
            TO THE EXTENT PERMITTED BY LAW, THE TOTAL LIABILITY OF 
            I.L.N SOFTWARE AND ITS SUPPLIERS AND DISTRIBUTORS, FOR ANY CLAIMS 
            UNDER THESE TERMS, INCLUDING FOR ANY IMPLIED WARRANTIES, IS LIMITED TO THE 
            AMOUNT YOU PAID US TO USE THE SERVICES 
            (OR, IF WE CHOOSE, TO SUPPLYING YOU THE SERVICES AGAIN). 
            <br /><br />
            IN ALL CASES, I.L.N SOFTWARE, WILL NOT BE LIABLE FOR ANY 
            LOSS OR DAMAGE THAT IS NOT REASONABLY FORESEEABLE
        </p>
    </section>
    <section>
        <h2>Business uses of our Services</h2>
        <p>
            If you are using our Services on behalf of a business, 
            that business accepts these terms. It will hold harmless and 
            indemnify I.L.N Software and its affiliates, officers, agents, 
            and employees from any claim, suit or action arising from or 
            related to the use of the Services or violation of these terms, 
            including any liability or expense arising from claims, losses, 
            damages, suits, judgments, litigation costs and attorneys’ fees.
        </p>
    </section>
    <section>
        <h2>About these Terms</h2>
        <p>
            We may modify these terms or any additional terms that apply to a 
            Service to, for example, reflect changes to the law or changes to our 
            Services. You should look at the terms regularly. 
            We’ll post notice of modifications to these terms on this page. 
            We’ll post notice of modified additional terms in the applicable 
            Service. Changes will not apply retroactively and will become effective 
            no sooner than fourteen days after they are posted. However, 
            changes addressing new functions for a Service or changes made for 
            legal reasons will be effective immediately. If you do not agree to 
            the modified terms for a Service, you should discontinue your use of that Service.
            <br /><br />
            If there is a conflict between these terms and the additional terms, 
            the additional terms will control for that conflict. 
            <br /><br />
            These terms control the relationship between I.L.N Software and you. They do not 
            create any third party beneficiary rights. 
            <br /><br />
            If you do not comply with these terms, and we don’t take action right away, 
            this doesn’t mean that we are giving up any rights that we may have 
            (such as taking action in the future). 
            <br /><br />
            If it turns out that a particular term is not enforceable, 
            this will not affect any other terms. 
            <br /><br />
            The laws of Israel, will apply to any disputes arising out of or relating to 
            these terms or the Services. All claims arising out of or relating to these terms 
            or the Services will be litigated exclusively in the courts of Israel, and you and 
            I.L.N Software consent to personal jurisdiction in those courts.
        </p>
    </section>
</article>
<aside></aside>
<footer>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/views/parts/footer.php'; ?>
</footer>
</body>
</html>
