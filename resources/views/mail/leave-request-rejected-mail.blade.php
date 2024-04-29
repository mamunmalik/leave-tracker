<x-mail::message>
Dear {{ $data['name'] }},

We regret to inform you that your leave request has been rejected due to **{{ $data['comments'] }}**. We understand the importance of your request and the inconvenience this may cause. Please refer to the details below:

- Type of leave: **{{ $data['leave_type'] }}**
- Reason of leave: **{{ $data['leave_reason'] }}**
- Dates: **{{ $data['start_date'] }}** to **{{ $data['end_date'] }}**

If you have any concerns or would like to discuss this further, please don't hesitate to contact us.

Thank you for your understanding.

Sincerely,<br>
{{ config('app.name') }}
</x-mail::message>
