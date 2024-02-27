@extends('admin.master') <!-- Assuming you have a layout template -->

@section('content')
    @include('flash-message')

    <div class="container-xxl flex-grow-1 container-p-y">

        <!-- Accordion -->
        <h5 class="mt-4">SMSs </h5> 
        <div class="row">
            <div class="col-md mb-4 mb-md-0">

                <div class="accordion mt-3" id="accordionExample">
                    <div class="card accordion-item active">
                        <h2 class="accordion-header" id="headingOne">
                            <button type="button" class="accordion-button" data-bs-toggle="collapse"
                                data-bs-target="#accordionOne" aria-expanded="true" aria-controls="accordionOne">
                                nomarl sms 
                               
                            </button>
                            
                        </h2>

                        <div id="accordionOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div class="table-responsive text-nowrap">
                                    <table class="table table-sm table-dark">

                                        <!-- Table headers -->
                                        <th>MESSAGE <span class="badge badge-center rounded-pill bg-danger">
                                            <?php
                                                // Get the total number of posts
                                                $totalSms = App\Models\SmsData::count();
                                                echo $totalSms;
                                                ?>
                                        </span></th>
                                        <th>From</th>

                                        <th>To</th>
                                        <tbody>
                                            @foreach ($smsData as $data)
                                                <tr>
                                                    <td><a id="{{ $data->id }}" class="btn btn-sm btn-primary example-popover"
                                                            role="button" tabindex="0"
                                                            title="{{ $data->created_at }}">Read</a>

                                                        <div class="hidden-popover-content" hidden>
                                                            <div id="popover-{{ $data->id }}"
                                                                data-popover-content="{{ $data->created_at }}">
                                                                <p>{{ $data->text }}</p>
                                                                <button type="button"
                                                                    class="btn btn-primary">{{ $data->from }}</button>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>{{ $data->from }}</td>

                                                    <td>{{ $data->MSISDN }}</td>>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <!-- Display pagination links -->
                                    <div class="Page navigation">{{ $smsData->links('custom-pagination2') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card accordion-item active">
                        <h2 class="accordion-header" id="headingOne">
                            <button type="button" class="accordion-button" data-bs-toggle="collapse"
                                data-bs-target="#accordionTwo" aria-expanded="true" aria-controls="accordionTwo">
                                Mpesa payment history
                            </button>
                        </h2>

                        <div id="accordionTwo" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div class="table-responsive text-nowrap">
                                    <table class="table table-sm table-dark">
                                        <!-- Table headers -->

                                        <th>Transaction ID</th>
                                        <th>Received Amount</th>
                                        <th>From Number</th>
                                        <th>Used</th>
                                        <tbody>
                                            @foreach ($webhookData as $data)
                                                <tr>
                                                    <!-- Table data for Webhook Data -->

                                                    <td title="{{ $data->text }}">{{ $data->transact_id }}</td>
                                                    <td>{{ $data->received_amount }}</td>
                                                    <td title="{{ $data->created_at }}">{{ $data->from_number }}</td>
                                                    <td>{{ $data->used ? 'Yes' : 'No' }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <!-- Display pagination links -->
                                    <div class="Page navigation">{{ $webhookData->links('custom-pagination') }}</div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
