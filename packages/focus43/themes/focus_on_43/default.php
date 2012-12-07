<?php defined('C5_EXECUTE') or die(_("Access Denied.")); ?>

<!DOCTYPE html>
<html dir="ltr" lang="en-US">

    <head>

        <?php Loader::element('header_required'); ?>

        <?php
        // move navbar down so we can get to c5 bar in admin mode
        if (User::isLoggedIn()) {
            echo "<style type=text/css> body { top: -48px; } .navbar { margin-top:48px; z-index:5; } </style>";
        }

        if ( count ($teamMembers) > 0 ) {
            foreach($teamMembers AS $userObj){
                echo "<link rel='team-member' href='{$userObj->getAttribute('photo_real')->getURL()}'>";
            }
        }
        ?>

    </head>

    <body data-spy="scroll">

    <?php Loader::packageElement('navbar', 'focus43'); ?>

        <div id="wrapper">

            <div id="home" class="jumbotron masthead">
                <div class="container">
                    <div class="logo">
                        <img src="<?php echo F43_PACKAGE_IMAGES_DIR; ?>logo-text.png">
                    </div>
                    <p><?php $a = new Area('Tagline'); $a->display($c); ?></p>
                </div>

                <div class="social">
                    <div class="container">
                        <ul class="f43-social-buttons">
                            <li class="twitter-btn">
                                <a href="https://twitter.com/focus43dev" target="_blank" class="twitter-button diyIcon"></a>
                            </li>
                            <li class="linkedin-btn">
                                <a href="http://www.linkedin.com/company/2814935" target="_blank" class="linkedin-button diyIcon" ></a>
                            </li>
                            <li class="facebook-btn">
                                <a href="https://facebook.com/focus43" target="_blank" class="facebook-button diyIcon" ></a>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>



            <div class="container">

                <div class="marketing" id="about-us">
                    <h1>What we can do for you</h1>
                    <p class="marketing-byline"><?php $a = new Area('We Can Do For You - Main'); $a->display($c); ?></p>
                    <p></p>
                    <div class="row-fluid">
                        <div class="span4">
                            <h2>Apps, apps, apps!</h2>
                            <?php $a = new Area('We Can Do For You - First'); $a->display($c); ?>
                        </div>
                        <div class="span4">
                            <h2>Your Website</h2>
                            <?php $a = new Area('We Can Do For You - Second'); $a->display($c); ?>
                        </div>
                        <div class="span4">
                            <h2>MVP</h2>
                            <?php $a = new Area('We Can Do For You - Third'); $a->display($c); ?>
                        </div>
                    </div>

                    <hr class="soften">

                    <h1>The Nerds</h1>
                    <div class="row-fluid team item">
                        <?php
                        // TODO: add carousel if more than 3 members
                        if ( count ($teamMembers) > 0 ) {
                            foreach($teamMembers AS $userObj){
                                Loader::packageElement( 'team_member', 'focus43', array( 'userObj' => $userObj ) );
                            }
                        }

    //                  ?>
                    </div>


                    <hr class="soften">

                    <h1>Stuff we've built</h1>
                    <div class="row-fluid" id="examples">
                        <ul class="thumbnails example-sites">
<!--                          All the image links in here gets the thumbnail class added onLoad -->
                             <?php // TODO: add automatic setting of correct classes dep on number of examples
                                   // add carousel to this if li count is > 4, still only display two at a time ?>
                            <li class="span6">
                                <?php $a = new Area('Work Example 1 IMAGE'); $a->display($c); ?>
                            </li>

                            <li class="span6">
                                <?php $a = new Area('Work Example 2 IMAGE'); $a->display($c); ?>
                            </li>
                        </ul>
                    </div>

                </div>

            </div>

        </div>

<!-- Footer
================================================== -->
<footer class="footer">
    <div class="container">
        <p class="pull-right"><a href="#" class="back-up diyIcon"></a></p>
        <!--<ul class="footer-links">-->
        <!--<li><a href="http://blog.getbootstrap.com">Blog</a></li>-->
        <!--<li class="muted">&middot;</li>-->
        <!--<li><a href="https://github.com/twitter/bootstrap/issues?state=open">Issues</a></li>-->
        <!--<li class="muted">&middot;</li>-->
        <!--<li><a href="https://github.com/twitter/bootstrap/wiki">Roadmap and changelog</a></li>-->
        <!--</ul>-->
    </div>
</footer>

    <?php
        // CONCRETE5 REQ'D ELEMENT //
        Loader::element('footer_required');
    ?>

    </body>
</html>