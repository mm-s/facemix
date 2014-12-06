<?
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
</body>
</html>
