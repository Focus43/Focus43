<?php
/**
 * Created by JetBrains PhpStorm.
 * User: superrunt
 * Date: 12/5/12
 * Time: 8:26 AM
 * To change this template use File | Settings | File Templates.
 */

$name  = $userObj->uName;
$drawnPhotoObj 	= $userObj->getAttribute('photo_drawn'); /** @var $drawnPhotoObj FileVersion */
$realPhotoObj	= $userObj->getAttribute('photo_real'); /** @var $realPhotoObj FileVersion */
?>


    <div class="span4  <?php echo $name; ?>">
        <a class="person <?php echo $name; ?>" href="#<?php echo $name; ?>"><img src="<?php echo $drawnPhotoObj->getURL(); ?>" class="img-circle"> </a>
        <h5><?php echo ucfirst($name); ?></h5>

        <div class='peeps-deets'>
            <a class='email diyIcon' href='#contact-modal' data-toggle='modal'></a>
            <a class='linkedin diyIcon' href='http://www.linkedin.com/profile/view?id=<?php echo $userObj->getAttribute('linkedin'); ?>' target='_blank'></a>
        </div>
    </div>



<script type="text/javascript">

    $(window).load(function(){

        // TODO: all this could be put into global method called configureTeamMember(name, linkedin, fullname, imagepath)

        // rollover state
        $('.team a.person.<?php echo $name; ?> img').on( {

            'click': function (e) { e.preventDefault() },

            'mouseenter': function (e) {
                var $this = $(this)
                $this.fadeOut('fast', function () {
                    $this.attr('src', '<?php echo $realPhotoObj->getURL(); ?>');
                    $this.addClass('on');
                    $this.fadeIn('fast');
                })
            },

            'mouseleave': function (e) {
                var $this = $(this)
                $this.fadeOut('fast', function () {
                    $this.attr('src', '<?php echo $drawnPhotoObj->getURL(); ?>');
                    $this.removeClass('on');
                    $this.fadeIn('fast');
                })
            }

        });

        // popover
        var deets = $('.team a.person.<?php echo $name; ?>').siblings('.peeps-deets')

        $('.team .span4.<?php echo $name; ?> a').popover({
            html: true,
            content: function  () { return deets.html() },
            title: '<?php echo $userObj->getAttribute('full_name'); ?>',
            placement: 'bottom',
            delay: { show: 500, hide: 100 }
        })
    })

</script>
