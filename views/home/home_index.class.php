<?php

class HomeIndex extends IndexView{
    public function display(){
        parent::displayHeader("Infinibank");
        ?>
        <div class="hero-banner">
            <div class="banner-text">
                Banking in the New Age
            </div>
        </div>
        <div class="teaser">
            <h1>Find your Solution</h1>
            <div class="teaser-row">
                <div class="category">
                    <img class="icon" src="www/images/icons8-cryptocurrency-50.png" alt="cryptocurrency icon">
                    <h3>Cryptocurrency</h3>
                </div>
                <div class="category">
                    <img class="icon" src="www/images/icons8-piggy-bank-64.png" alt="piggy bank icon">
                    <h3>Savings Accounts</h3>
                </div>
                <div class="category">
                    <img class="icon" src="www/images/icons8-money-bag-50.png" alt="money bag icon">
                    <h3>Checking Accounts</h3>
                </div>
                <div class="category">
                    <img class="icon" src="www/images/icons8-bank-check-68.png" alt="bank check icon">
                    <h3>eDeposit Checks</h3>
                </div>
            </div>

            <div class="teaser-row">
                <div class="teaser-image" id="one-place"></div>
                <div class="teaser-text">
                    <h2>Everything in One Place</h2>
                    <p>No matter the currency, store it all in one convenient place</p>
                </div>
            </div>

            <div class="teaser-row">
                <div class="teaser-text">
                    <h2>Be at Ease</h2>
                    <p>Sleep well at night knowing all your funds are secure</p>
                </div>

                <div class="teaser-image" id="security"></div>
            </div>

            <div class="teaser-row">
                <div class="teaser-image" id="real-time"></div>
                <div class="teaser-text">
                    <h2>Always Know</h2>
                    <p>Real-time banking application to allow you to always see your balances.</p>
                </div>
            </div>
        </div>

        <?php
        parent::displayFooter();
    }

}