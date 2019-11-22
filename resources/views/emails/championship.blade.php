@component('mail::message')
	
Hello educators!
================

Each year, we host Learn Fresh Championship Series events in cities across the United States! Today, we are excited to announce details for your local championship event. Included below is current event information:

**Date:** {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $event->event_date)->format('F jS, Y') }}<br>
**Time:** {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $event->event_date)->format('g:ia') }}<br>
**Location:** {{ $event->location }}<br>
**Address:** {{ $event->address }}<br><br>
**Event Details:**<br>
{!! $event->details !!}

How to RSVP:
------------

Please RSVP with the appropriate amount of attendees via the LFCA event page:

@component('mail::button', ['url' => 'https://www.mylfca.com/event/' . $event->id,'color' => 'blue'])
RSVP HERE
@endcomponent

All RSVPS are due no later than two weeks before the event date. Please do not be late!

Please communicate any questions to Calvin Sibert at [calvin@learnfresh.org](mailto:calvin@learnfresh.org), and remember to submit RSVPs as soon as possible.

Thank you!

The Learn Fresh Team
	
@endcomponent