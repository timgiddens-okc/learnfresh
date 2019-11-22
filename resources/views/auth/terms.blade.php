@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                		<div class="row">
											<div class="col-sm-12">
												@foreach (['danger', 'warning', 'success', 'info'] as $msg)
										      @if(Session::has('alert-' . $msg))
										      <div class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>
										      @endif
										    @endforeach
										    	<div class="alert alert-info">Please do not refresh the page during registration.</div>
											</div>
										</div>
                    <form class="form-horizontal terms" role="form" method="POST" action="/register/terms">
                        {{ csrf_field() }}
    
												<div class="row">
													<div class="col-sm-12">
                        <h4>Learn Fresh Education Co. Privacy Statement
&
Children’s Privacy Statement<br><span class="label label-default">Updated September 7, 2018</span></h4>
													</div>
												</div>
                        
                        <div class="t-and-c">

<p>This Privacy Statement applies to the web sites and mobile applications provided by Learn<br />
Fresh Education Co. (collectively, "Learn Fresh", "we", "our", or "us"). This Privacy<br />
Statement governs your use of our Sites and Apps, regardless of how you access or<br />
use them. By “Sites”, we mean any website or URL of ours that we have linked to this<br />
Privacy Statement and all features, applications, content, and downloads that are<br />
operated by us and that are available through the Sites, and by “Mobile Apps” and<br />
“Apps”, we mean our products and services that we make available via mobile<br />
telecommunications platforms and/or through social networking platforms or app stores. If you are visiting the Sites, please also review the Sites’ Term of Service.</p>

<p>We want you and your family to have fun surfing all our Sites and using our Apps, and<br />
urge you and your family to follow common sense whenever disclosing personal<br />
information - on this Site or anywhere else.</p>

<p>We encourage you to review our complete Privacy Statement in detail, as it includes<br />
important information, but provided is a short summary for convenience.</p>

<h5>
OVERVIEW</h5>

<p><strong>CHILDREN</strong><br />
We take many special precautions to protect the privacy of children under 13.</p>

<p>At our websites through our apps intended for children, we do not collect<br />
personal contact information (like full name, birthdate, phone number or home<br />
address) from children without the consent of a parent or legal guardian, except<br />
in limited circumstances authorized by law.</p>

<p>We collect some information (like IP address, mobile device UDID, operating<br />
system, etc.) automatically and use technology like cookies to provide<br />
functionality and support our operations. Learn Fresh does not permit interest based advertising on Sites or Apps directed to children under 13 or where we<br />
have actual knowledge that a child is under 13.</p>

<p>We do not ask for more personal information than is necessary for a child to<br />
participate in an activity.</p>

<p>We take steps to prevent children from posting or publicly disclosing personal<br />
contact information.</p>

<p>Parents can ask us to update or delete their children’s information.</p>

<p>To participate in games, we might ask your child to "register." They can often do so<br />
anonymously by just providing a user name, and password. When we ask for your <br />
child's user name, we encourage them to use a "screen name" (not their real name) that<br />
only they know. Sometimes we will ask your child to make up a special password so<br />
that only they can see their customized areas on the Site. We use technology, like<br />
cookies, to recognize visitors by their username when they revisit our Site and to<br />
screen for age in accordance with COPPA. We may also use technology for similar<br />
purposes in our Apps.</p>

<p>We may sometimes need a child’s email address and/or your e-mail address. We may<br />
ask a child for your e-mail address so we can notify you of your child’s interest in our<br />
Site, and to recover their password in the event of them forgetting it. If we need more<br />
than just your child's first name (or screen name) and email address for your child to<br />
participate in a particular online activity or App, we will ask your child for your e-mail or<br />
mailing address so that we can notify you of your child's request and get your<br />
permission. When we ask for your permission, we will tell you what we will do with the<br />
information you or your child provides us, and how you can review your child's<br />
information and ask us to delete the information. With your verifiable consent, we may<br />
collect other personal information from your child such as a last name or home address<br />
when the information is necessary for a particular activity.</p>

<p>We don't keep your (or your child's) email address unless you tell us it is okay. If social<br />
networking opportunities are available at our children’s websites, they are structured so<br />
that no personal information is shared between visitors or verifiable parental consent is<br />
obtained.</p>

<p>We also use technology to facilitate the ability to play games, to recognize returning<br />
visitors, for research, and for other purposes, including to screen under-age visitors<br />
from certain features or areas intended for older visitors, and to collect certain<br />
information automatically. We require our advertising service partners to comply with<br />
self-regulatory guidelines on targeted advertising. Learn Fresh does not permit interest based advertising on Sites directed to children under 13 or where we have actual knowledge that a child is under 13.</p>

<p>If you no longer wish your child to participate in an email newsletter, simply click on the<br />
link that is provided for removal or contact us at [info@learnfresh.org]. Upon proper<br />
identification, a parent or legal guardian may review the personal information we have<br />
collected about their child, update their child’s contact details, request deletion, or<br />
refuse to allow further collection or use of the information.</p>

<p>Please note, however, if you ask us to delete your child's information, your child may not<br />
be able to participate in some online or App activities.</p>

<p><strong>WHAT WE COLLECT – ADULTS AND TEENS</strong><br />
We collect information from adults and teens to serve your needs, manage our content<br />
and advertising, operate efficiently, and improve our products and services.</p>

<p>We collect personal contact information, like email address or phone number,<br />
from consumers 13 or older when voluntarily submitted, including when needed <br />
to fulfill transactions. Registration may be required to use some Sites, services or<br />
Apps.</p>

<p>We may obtain information from commercial sources and combine it with<br />
information we have collected.</p>

<p>Certain information may be collected automatically at our Sites or Apps, like your IP address, UDID, browser setting, operating system, referring domain, language preferences, mobile carrier if you are using a mobile device, general location (e.g., zip code, but not specific address without consent) and other information.</p>

<p>Third parties may also collect certain information via our Sites or Apps.</p>

<p><strong>USER-GENERATED</strong><br />
You may be able to post or upload content, like comments, reviews, photos, etc.<br />
Registration may be required.</p>

<p>At kids’ Sites, filtering technology is used to prevent children from posting<br />
personal contact information without parental consent.</p>

<p><strong>COOKIES AND TECHNOLOGY</strong><br />
Our Sites, services and Apps use technology, like cookies and web beacons, to<br />
manage registrations or access to certain features, store your settings and<br />
preferences, conduct age-screening, offer you personalized content, shop, help<br />
us understand the features that appeal to visitors, and manage advertising,<br />
among other things.</p>

<p>We also work with third parties who offer analytics or deliver targeted ads online or through Apps. They use technology and collect device identifiers, such as your IP address or mobile UDID, and information on your activities, to do so. You can opt out of receiving targeted ads but will still see ads, although they may be less relevant to you.</p>

<p>Tools are available to help you control some of these technologies.</p>

<p>Learn Fresh and its agents or service providers or business partners may receive and store certain information automatically when you visit our Sites, use an online service or download or use a mobile App. This may include information on your browser type and operating system, the pages that you view, referring sites (sites you visited before you came to our site and sites you go to after you visit our site), IP addresses, or unique device identifiers associated with mobile devices, smartphones, etc. This information allows us to count the total number of "hits" on our Sites or installation and frequency of use of our Apps.</p>

<p>We collect certain information using technology, like cookies and pixel tags. We<br />
may also use “Flash” cookies in connection with some games or other content to store game and activity progress for the Flash player or to store bandwidth <br />
information for the performance of the Flash player. The information stored in any Flash cookie deployed on this Site does not include your name.</p>

<p>Third party analytics and advertising networks also use cookies, web beacons,<br />
pixel tags, clear GIFs and other technology to collect certain information<br />
automatically. Advertising networks may use this information to serve you<br />
targeted ads for products and services that, based on your activities, are likely to<br />
be of interest to you (“interest-based advertising”). Learn Fresh does not permit<br />
interest-based advertising on Sites directed to children under 13 or where we<br />
have actual knowledge that a child is under 13.</p>

<p>Other business partners, like social media sites, may also use cookies and<br />
similar technology to collect certain information about your visits to our Sites<br />
through social media plugins. You may have the option to log in to one of our<br />
websites using your social media username and password; if so, the social<br />
media operator (e.g., Facebook, YouTube, Twitter, etc.) may be able to link your<br />
activities at our Site to your registration information.</p>

<p>Find out more about these technologies and how you can control their use below.</p>

<p><strong>COOKIES</strong><br />
A "cookie" is a small file that does not contain personally identifiable information<br />
and is saved on your computer or mobile device. Cookies help improve your user<br />
experience, and allow us to analyze our Sites and Apps and manage our advertising.</p>

<p>Our cookies help to give you faster access to pages you have already visited;<br />
they allow you to personalize your pages and us to customize our offerings; and<br />
they help you to participate in some activities or events on our Sites. For<br />
instance, some of our Sites have scavenger or treasure hunts, and we need to<br />
use cookies to keep track of your progress. If you leave our Site and then return,<br />
cookies will tell us what things you have already collected so that you do not<br />
have to start all over again. Cookies can also keep track of items in your<br />
shopping cart and wishlist in our online stores, and may be used to help you<br />
engage in other activities, like comparison shopping.</p>

<p>We also use cookies to help us figure out how many people visit our Sites, which of our Web pages they go to and how long they stay there. This information helps us figure out which of our Web features are successes and what Sites might need improvement. For administrative purposes, we collect IP addresses. Certain Internet service providers may assign the same IP address to many users. The IP address allows us to count the total number of "hits" on our sites. Your IP address and cookies are not connected to any personally identifiable or online contact information, like a name or email address, unless you register or order at our online stores; however, if you register at our online stores, all information we collect will be associated with your customer file.</p>

<p>You can set your computer to warn you each time a cookie is being sent or turn off all cookies (except Flash cookies – see below) through your Internet browser (e.g., Internet Explorer or Safari). Check your browser's Help menu or your built- in mobile device settings to find out how. Some mobile devices store cookies not only in areas connected to the browser, but also in areas that are app-specific so these cookies cannot be controlled by the browser settings. Check your app settings options on your mobile device to find out how to manage or delete cookies that may be stored in these other areas.</p>

<p>Please note that if you do not accept cookies, some features or activities may not be available to you.</p>

<p><strong>FLASH COOKIES</strong><br />
Flash Cookies, also known as local shared objects (“LSOs”), are built for use with<br />
Adobe® Flash® Player. LSOs act like cookies in that they store information to<br />
provide you with a more customized experience, but LSOs can store complex<br />
data that cookies cannot, and LSOs are not deleted or rejected if you set your<br />
browser to delete or reject cookies. The information stored in any LSO deployed<br />
by our Sites do not include your name. Although browser settings will not allow<br />
you to manage LSOs, you may be able to manage them in other ways. To find<br />
out more about how to manage or delete LSOs, visit http://www.adobe.com/<br />
products/flashplayer/articles/lso/</p>

<p><strong>WEB BEACONS, PIXEL TAGS, CLEAR GIFS</strong><br />
We also use other technology, called web beacons, pixel tags or clear GIFs, to<br />
provide us with other important anonymous information, such as when an email<br />
has been opened. Companies that advertise on our Sites may also place web<br />
beacons in their ads to help develop statistics on the effectiveness of advertising<br />
at our Sites. We do not control web beacons in third party ads.</p>

<p><strong>APPS</strong><br />
When downloading an App (or using an App that relies on online features made<br />
available through your mobile platform), the app store will collect certain device<br />
and app-related information. Learn Fresh does not control the data collection or<br />
privacy practices of those stores. You should review the privacy policy and terms<br />
of use of any mobile application store before downloading or using any app and<br />
review and use available controls and settings on your device to reflect your<br />
preferences.</p>

<p><strong>LOCATION INFORMATION</strong><br />
For some Apps or services, we or our third party service and content providers<br />
and analytics companies may collect location information, including location<br />
information provided either by a mobile device interacting with one of our Apps or<br />
associated with your IP address or WiFi network. These features might enable<br />
you to engage in activities like find a nearby store or play certain games, for<br />
example. You can generally limit or prohibit the collection of location information<br />
by using the built-in settings on your mobile device. You will typically be notified if<br />
the App or service collects location information and given a chance to agree. We<br />
do not permit collection of precise location information (actual address) in mobile<br />
Apps without your consent. Child-directed Apps do not collect precise location<br />
Information.</p>

<p><strong>WEBSITE AND MOBILE APP ANALYTICS</strong><br />
We or our agents and service partners may use cookies and web beacons to<br />
analyze the effectiveness of our Sites, services and Apps. This typically involves<br />
collecting your IP address or UDID and information on your activities, like the<br />
sites you visit or frequency of use of an App. We require these providers to<br />
commit to maintaining the anonymity of this information. You may be able to opt<br />
out of data collection or use by some third party analytics companies who work<br />
with us. Contact us if you would like information on our third party analytics<br />
service providers.</p>

<p><strong>TARGETED ADVERTISING</strong><br />
Learn Fresh may work with third party online or mobile network advertisers that<br />
use cookies, pixels, or transparent GIF files to help us manage advertising at our<br />
Sites or Apps intended for people over the age of 13, and measure its<br />
effectiveness. This includes our collector Sites and online stores. GIF files enable<br />
third party ad networks to recognize a unique cookie on your Web browser or<br />
mobile device. The cookie may be placed by us, or by another advertiser that<br />
works with our third party network advertiser. The information that we collect and<br />
share in this fashion is de-identified and not personally identifiable. It does not<br />
contain your name, address, telephone number, or email address. However, it<br />
may keep track of the sites you have visited that are associated with the ad<br />
network. This information may be used for the purpose of targeting<br />
advertisements on our Sites and other sites based on those interests, and to<br />
learn which ads bring users to our Sites.</p>

<p>We support the cross-industry Self-Regulatory Program for Online Behavioral<br />
Advertising as managed by the Digital Advertising Alliance. As part of this<br />
service, our online advertisements and Web sites are sometimes delivered with<br />
icons that help consumers understand how their data is being used and provide<br />
choice options to consumers that want more control. For more information about<br />
our network advertisers, including information about how to opt out of<br />
technologies that they control, please follow the directions on the AdChoices icon<br />
within any interest or behavior based advertisement. Some of our Sites may also<br />
include the AdChoices icon on the home page. You can also visit websites<br />
operated by the Network Advertising Initiative and Digital Advertising Alliance to<br />
access opt-out tools available from those participating in the program.</p>

<p>Participating network advertisers will be listed at those sites. Opting out means<br />
that you will still see ads, but they may not be tailored to your specific interests.<br />
Please note: your opt-out choices are browser-specific and device-specific.</p>

<p><strong>SOCIAL MEDIA PLATFORMS AND PLUGINS</strong><br />
If you are a member of a social media network, like Facebook, a cookie may be<br />
sent to that network when you access a page of our Site or an App that links to<br />
their website through a plugin (such as Facebook’s “Like” or Google “+1”<br />
buttons), register or log into your account at their platform, or use your social<br />
media username and password to log into our Site where you have the option to <br />
do so. That may enable them and us to link your activities with your personal<br />
registration information at their site, and may include notifying your friends or<br />
connections about your activities at our Site, and using tracking technologies to<br />
monitor your online activities in order to serve targeted ads. The social media<br />
networks' privacy policy and terms apply to your use of their platforms. Your<br />
browser or device may allow you to block these technologies but you should visit<br />
the third party website and review their privacy policy and your registration profile<br />
or account to find out your options.</p>

<p><strong>USE OF INFORMATION</strong><br />
We use all information we collect to provide and improve our products and services,<br />
understand our consumers, and manage content and advertising. We use the personal<br />
information we collect for the purposes indicated at the time it is provided. For instance,<br />
we use contest registration information to notify contest winners; if you purchase a<br />
product, we use the information to fulfill your order. If you shop online at one of our<br />
stores, you will automatically receive a catalogue unless you opt out. We share your<br />
catalogue mailing address (but not your e-mail address) with carefully selected<br />
companies whose products or services may interest you. Occasionally, we might also<br />
send e-mail or postal mail about upcoming Learn Fresh products, Site updates, or<br />
promotions. We may also share information with other Learn Fresh brands and Learn<br />
Fresh family companies so that they can let you and your family know about products<br />
that might be of interest. Information that we or our agents or service providers collect<br />
using technology is used to help us understand our visitors, improve our products and<br />
services, manage our content and advertising, fulfill requests, measure the<br />
effectiveness or our advertising, maintain Site security, and protect intellectual property.</p>

<p><strong>CHOICES</strong><br />
We respect your choices about receiving promotional offers and updates from us.</p>

<p><strong>APP CONTROLS</strong><br />
Your device may allow you to block or manage push notifications, location information,<br />
in-app purchases, or ability to access the web.</p>

<p><strong>SHARING</strong><br />
We may share information:</p>

<p>
Within our family of companies, and with our agents and service providers.</p>

<p>
As necessary to satisfy a legal request, protect property or personal safety, when<br />
a business is bought or sold, or as otherwise allowed or required by law.</p>

<p><strong>LINKS</strong><br />
Learn Fresh Sites or Apps may link to or use other content from the Internet, including<br />
content offered by third parties that we do not control and whose privacy and data<br />
collection practices may differ from ours. Your computer or mobile device settings may <br />
allow you to block or partially block web access, but those settings may not be effective<br />
in all cases.</p>

<p>
OTHER IMPORTANT INFORMATION</p>

<p><strong>SECURITY</strong><br />
We strive to maintain the security of information but cannot guarantee that<br />
information security measures are fail-safe</p>

<p><strong>OUR LOCATION; DATA TRANSFERS</strong><br />
This Site and the servers that make this Site available may not be located in your<br />
country of residence and are governed by U.S. law. By using this Site, you agree<br />
to the transfer, collection, processing and use of data by this Site and us. This<br />
Site, the servers that make this Site available, and databases where we house<br />
information may not be located in your country of residence, and applicable<br />
privacy laws may differ. However, we take reasonable steps to safeguard<br />
personal information as outlined in this Privacy Statement. By using this Site, you<br />
agree to the transfer, collection, processing and use of data as set forth in this<br />
Privacy Statement, our Terms and Conditions, and any other terms provided at<br />
the time of collection.</p>

<p><strong>UPDATES</strong><br />
We will update this Privacy Statement from time to time by posting the updated<br />
Privacy Statement online. We will not change how we handle previously collected<br />
information without providing notice.</p>

<p><strong>CALIFORNIA PRIVACY RIGHTS</strong><br />
If you are a resident of California, you have certain rights. Under California Civil<br />
Code § 1798.83, California residents have the right to receive, once a year,<br />
information about third parties with whom we have shared information about you<br />
for their marketing purposes during the previous calendar year, and a description<br />
of the categories of personal information shared. To make such a request, please<br />
complete and send us the Privacy Request Form. We will respond to you within<br />
30 days of receiving such a request.</p>

<p><strong>QUESTIONS</strong><br />
We strive always to be transparent and clear about our policies. Please contact us at<br />
info@learnfresh.org if you have questions.</p>

<p><strong>A SPECIAL NOTE FOR PARENTS AND LEGAL GUARDIANS:</strong><br />
Learn Fresh adheres to the U.S. Children's Online Privacy Protection Act of 1998<br />
(“COPPA”) and the guidelines of the Children's Advertising Review Unit (“CARU”) of the<br />
Council of Better Business Bureaus, Inc. in our web Sites, online services and Apps<br />
directed to children under 13. Wherever we refer to “children” or a “child” in this Privacy<br />
Statement, we mean children under 13. Please help us protect your children's privacy<br />
by instructing them never to provide personal information (like their full name, e-mail<br />
address, home address, telephone number, etc.) without your permission.</p>

<p><strong>A SPECIAL NOTE TO KIDS:</strong><br />
If you are under 13, you should get your parent's or legal guardian's permission before<br />
giving out your contact information, like email address or phone number, or any other<br />
personal information, to Learn Fresh or to anyone else.</p>

<p>If you want to stop receiving promotional updates or product information at any time, or<br />
would like to update your contact information, just contact us at<br />
info@learnfresh.org.</p>

<p>Our mailings and e-mail will also include information on how to opt-out in the future. E-mail opt-out requests will be processed within 10 business days.</p>

<p>Postal mailing opt-out requests may take longer.</p>
                        </div>
                        
                        <ul>
                        	<li><strong>User has access to LFCA for 1 calendar year from date of purchase.</strong></li>
										
													@if(\Auth::user()->account_level == 1)                       
                        		<li>You will be limited to 4 board games.</li>                       
													@elseif(\Auth::user()->account_level == 2)
                        		<li>You will be limited to 8 board games.</li>                        
													@endif
                        </ul>
                        
                        <p class="text-right"><input type="checkbox" name="agree" /> I agree to the above terms and conditions.</p>
                        
                        @if ($errors->has('agree'))
                        <div class="row">
                        	<div class="col-sm-12 text-right">
                            <div class="alert alert-danger">Please agree to the terms and conditions to continue. </div>
                        	</div>
                        </div>
                        @endif
                                       
                        <div class="row">
                        	<div class="col-sm-12 text-right">
                        		<button type="submit" class="btn btn-primary loader">Continue</button>
                        	</div>
                        </div>
                      
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection