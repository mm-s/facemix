<!DOCTYPE html>
<html>
<head>
 <meta charset="UTF-8"> 
 <title>facemix</title>

<!-- Include the PubNub Library -->
<script src="https://cdn.pubnub.com/pubnub.min.js"></script>

<!-- Instantiate PubNub -->
<script type="text/javascript">
var PUBNUB_facemix = PUBNUB.init({
publish_key: 'pub-c-c25d73f6-1b1e-4b49-813f-f5eda5ac120e',
subscribe_key: 'sub-c-496b23ee-7d21-11e4-812f-02ee2ddab7fe'
});

PUBNUB_facemix.subscribe({
channel: 'demo_tutorial',
message: function(m){console.log(m);},
connect: publish
}); 

function publish() {
    PUBNUB_facemix.publish({
    channel: 'demo_tutorial',
    message: {"text":"Hey!"}
});
} 


</script> 

    
    
</head>
<body>
<h2>facemix</h2>
</body>
</html>
