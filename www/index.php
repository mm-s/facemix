<?
session_start();

$ip=$_SERVER["REMOTE_ADDR"];







?> 

<!DOCTYPE html>
<html>
<head>
 <meta charset="UTF-8"> 
 <title>facemix</title>

<!-- Include the PubNub Library -->
<script src="https://cdn.pubnub.com/pubnub.min.js"></script>
<script src=”http://pubnub.github.io/webrtc/webrtc-beta-pubnub.js”></script>

<!-- Instantiate PubNub -->
<script type="text/javascript">
var pubnub = PUBNUB.init({
publish_key: 'pub-c-c25d73f6-1b1e-4b49-813f-f5eda5ac120e',
subscribe_key: 'sub-c-496b23ee-7d21-11e4-812f-02ee2ddab7fe',
uuid: '<?=$ip?>'
});

pubnub.subscribe({
channel: 'facemix',
message: function(m){console.log(m);},
connect: publish

}); 

function publish() {
    pubnub.here_now({
        channel: 'facemix',
        callback: function(m){console.log(m);}
    })



    pubnub.publish({
    channel: 'facemix',
    message: {"text":"Hey joe!"}
    });
    
    
    pubnub.here_now({
        channel: 'facemix',
        callback: function(m){console.log(m);}
    })
    
} 




</script> 

    
    
</head>
<body>
<h2>facemix</h2>
IP <?=$ip?> 



<!-- fork me. https://github.com/blog/273-github-ribbons -->
<a href="http://github.com/mm-s/facemix" target="_blank"><img style="position: absolute; top: 0; right: 0; border: 0;" src="http://s3.amazonaws.com/github/ribbons/forkme_right_gray_6d6d6d.png" alt="Fork me on GitHub" ></a>

<!--
src="https://camo.githubusercontent.com/a6677b08c955af8400f44c6298f40e7d19cc5b2d/68747470733a2f2f73332e616d617a6f6e6177732e636f6d2f6769746875622f726962626f6e732f666f726b6d655f72696768745f677261795f3664366436642e706e67"
alt="Fork me on GitHub" 
data-canonical-src="http://s3.amazonaws.com/github/ribbons/forkme_right_gray_6d6d6d.png"
-->

<!-- coinbase tip button -->
<br/><br/>
<hr/>
<div class="cb-tip-button" data-content-location="http://facemix.mm-studios.com" data-href="//www.coinbase.com/tip_buttons/show_tip" data-to-user-id="523c4e82a787b2fa4000002e"></div>
<script>!function(d,s,id) {var js,cjs=d.getElementsByTagName(s)[0],e=d.getElementById(id);if(e){return;}js=d.createElement(s);js.id=id;js.src="https://www.coinbase.com/assets/tips.js";cjs.parentNode.insertBefore(js,cjs);}(document, 'script', 'coinbase-tips');</script>


</body>
</html>
