<h5 class="mb-4">
    <i class="fas fa-chart-line grey"></i>
    @lang('dashboard.statistics')
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
</table>