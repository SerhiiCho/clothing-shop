<h5 class="mb-4">
    <i class="fas fa-chart-line grey"></i>
    @lang('dashboard.stats')
</h5>

<table class="table table-hover">
    <tr>
        <td>@lang('items.all_men_items'):</td>
        <td>{{ $all_men_items }}</td>
    </tr>
    <tr>
        <td>@lang('items.all_women_items'):</td>
        <td>{{ $all_women_items }}</td>
    </tr>
    <tr>
        <td>@lang('items.all_open_orders'):</td>
        <td>{{ $all_open_orders }}</td>
    </tr>
    <tr>
        <td>@lang('items.all_closed_orders'):</td>
        <td>{{ $all_closed_orders }}</td>
    </tr>
</table>