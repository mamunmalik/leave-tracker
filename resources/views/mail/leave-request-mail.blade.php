<x-mail::message>
Dear {{ $data['name'] }},

This is to acknowledge that your leave request has been received. We will review your request promptly and notify you of its status.
Please refer to the details below:

- Type of leave: **{{ $data['leave_type'] }}**
- Reason of leave: **{{ $data['leave_reason'] }}**
- Dates: **{{ $data['start_date'] }}** to **{{ $data['end_date'] }}**

Thank you,<br>
{{ config('app.name') }}
</x-mail::message>
