<x-mail::message>
Dear {{ $data['name'] }},

We are pleased to inform you that your leave request has been approved. Please refer to the details below:

- Type of leave: **{{ $data['leave_type'] }}**
- Reason of leave: **{{ $data['leave_reason'] }}**
- Dates: **{{ $data['start_date'] }}** to **{{ $data['end_date'] }}**

If you have any questions or need further assistance, feel free to reach out.

Best regards,<br>
{{ config('app.name') }}
</x-mail::message>
