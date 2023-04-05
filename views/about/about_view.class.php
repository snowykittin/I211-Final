<?php

class AboutView extends IndexView
{
    public function display(){
        //display page header
        $page_title = "InfiniBank - About";
        parent::displayHeader($page_title);
        ?>
            <div class="about-banner">
                <div class="banner-text">
                    We're glad you're here.
                </div>
            </div>
        <div class="about">
            <h1>About Infinibank</h1>
            <p>Infinibank is a groundbreaking financial institution that offers a convenient and innovative solution for clients who are tired of managing multiple bank accounts. At Infinibank, we believe that banking should be easy and accessible for everyone, which is why we offer a single account that allows clients to keep checking, savings, and cryptocurrency accounts all in one place.</p>

            <p>Our platform is designed to make banking simpler, faster, and more secure. Whether you're looking to manage your finances, pay bills, transfer funds, or invest in cryptocurrencies, Infinibank offers all the tools you need to achieve your financial goals. Our cutting-edge technology makes it easy to access your account from anywhere, whether you're on your desktop or mobile device.</p>

            <p>At Infinibank, we prioritize security and transparency, ensuring that our clients' funds are safe and their personal information is protected. Our team of financial experts is always available to provide exceptional customer service and support, helping clients navigate any challenges they may face.</p>

            <p>We are proud to offer a banking solution that meets the needs of modern consumers. By bringing together traditional banking services and cryptocurrency accounts, Infinibank is breaking down barriers and opening up new opportunities for clients to manage their finances. Our platform is designed to help clients save time, streamline their financial management, and maximize their potential for growth and success.</p>

            <p>Whether you're an individual, a business owner, or an investor, Infinibank offers the tools and resources you need to succeed in today's fast-paced financial landscape. Join us and experience the future of banking today!</p>
        </div>
        <div class="founders">
            <h1>Meet the Founders</h1>
            <div class="founder">
                <h2>Joseph Floreancig</h2>
                <p>My name is Joseph Floreancig at Infinibank, we offer a wide range of financial services, including traditional banking products like checking and savings accounts, as well as innovative solutions like cryptocurrency accounts. We're committed to making banking simple, convenient, and accessible for all of our customers, whether they're dealing with standard currencies or cryptocurrency. But we're not just a traditional bank. We also offer cryptocurrency accounts that allow our customers to easily buy, sell, and store digital currencies like Bitcoin, Ethereum, Tester, BNB, and USD Coin. Our cryptocurrency accounts are secure, easy to use, and designed to meet the needs of even the most demanding cryptocurrency investors. We're excited to hear from you and to see how you can contribute to our mission of making banking simple, accessible, and innovative for everyone, regardless of whether they're dealing with multiple currencies or cryptocurrencies.</p>
            </div>
            <div class="founder">
                <h2>Summer Sexton</h2>
                <p>Hello! My name is Summer, and I am one of the founders of Infinibank, a revolutionary banking institution that simplifies financial management for our clients. Before starting Infinibank,  I saw firsthand how complicated it can be for individuals and businesses to manage multiple bank accounts. In fact, I myself struggled with managing three different bank accounts, which led me to think that there must be a better way. That's why I helped create Infinibank, a bank that offers a single account that does everything you need it to do. I am proud to lead the Infinibank team and provide our clients with a banking solution that simplifies their financial lives. Thank you for considering Infinibank for your banking needs.
                </p>
            </div>
        </div>
        <div class="disclaimer">
            <h3>Disclaimer</h3>
            <p>This application is created as a final course project for I211. It is solely for teaching and learning purposes. As a course project, the goal is to learn how to do things, but not to get things done. Therefore, the code used in this project may not be most efficient or most effective. Furthermore, the code has not been tested in any production environment. If you want to use any code in this project in any production environment, use it at your own risk.</p>
        </div>

        <?php
        //display footer
        parent::displayFooter();

    }

}