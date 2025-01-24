
<script>
    function thermal_print(id) {

        $('#body_print').html(" ");
        jQuery.ajax({
            url: "job_info_thermal_modal_view_details/view/" + id,
            data: {
                id: id
            },
            type: "GET",
            cache: false,
            dataType: 'json',
            success: function(data) {
                console.log(data);
                var warrenty = 'No';
                if (data.items.ji_warranty_status == 1) {
                    warrenty = 'Yes';
                }
                const delivery_date = moment(data.items.ji_delivery_datetime).format('DD-MM-YYYY');
                const booking_date = moment(data.items.ji_recieve_datetime).format('DD-MM-YYYY');
                // const d = date('d-m-Y', strtotime( data.items.ji_delivery_datetime ));
                let faults = '';
                let accessories = '';
                $.each(data.complain_items, function(index, value) {
                    faults += value.jii_item_name + ', ';

                });
                $.each(data.accessory_items, function(index, value) {
                    accessories += value.jii_item_name + ', ';

                });

                var modalbody =
                    // '<div class="ticket">
                    `<p class="centered english"><strong> رسید ہمراہ ساتھ لائیں بغیررسید سیٹ نہیں ملےگا </strong></p>
                    <p class="centered english">Job Card</p>
                    <img class="img-center" src="{{ asset('') }}${data.company_profile.cp_logo}" alt="Logo" width="100" height="100">
                    <p class="centered english" style="line-height: 12px;"> ${data.company_profile.cp_address} - ${data.company_profile.cp_contact}  </p>
                    <table class="table job_t english">
                        <tbody style="max-height: none;overflow: hidden;">
                    <tr class="job_tr">
                        <th style="padding-left: 70px;">Job ID :</th>
                        <td style="padding-left: 100px;">${data.items.job_id}</td>

                    </tr>
                    <tr class="job_name" style="position: relative;top: 10px;">
                        <th>Consumer Name:</th>
                        <td>${data.items.cli_name}</td>
                    </tr>
                    <tr class="job_name">
                        <th>Contact Number:</th>
                        <td>${data.items.cli_number}</td>
                    </tr>
                    <tr>
                    <td colspan="2" style="border-top:2px dashed #000">&nbsp</td>
                    </tr>

                    <tr class="tr_line english">
                        <th>Receiving Date</th>
                        <td>${booking_date}</td>
                    </tr>
                    <tr class="tr_line">
                        <th>Brand</th>
                        <td>${data.items.bra_name}</td>
                    </tr>
                    <tr class="tr_line">
                        <th>Categary</th>
                        <td>${data.items.cat_name}</td>
                    </tr>
                    <tr class="tr_line">
                        <th>Model</th>
                        <td>${data.items.mod_name}</td>
                    </tr>
                    <tr class="tr_line">
                        <th>Fault</th>
                        <td class="content-line">${faults}</td>
                    </tr>
                    <tr>
                        <th>Accessories</th>
                        <td class="content-line">${accessories}</td>
                    </tr>
                    <tr class="tr_line">
                        <th>Warranty</th>
                        <td>${warrenty}</td>
                    </tr>
                    <tr class="tr_line">
                        <th>Est. Charges</th>
                        <td>${data.items.ji_estimated_cost}</td>
                    </tr>
                    <tr class="tr_line">
                        <th>Est. Delivery Date</th>
                        <td>${delivery_date}</td>
                    </tr>
                </tbody>
            </table>`;


                // let terms = data.company_profile.cp_terms.replace(/,/g, "<br>");
                let terms = data.company_profile.cp_terms;

                modalbody += `</p>
                    <span class="english" style="line-height: 5px;"> Terms & Conditions </span>
                    <p class="urdu"> ${terms} </p>`;
                // '</div>';
                $('#body_print').html(modalbody);


            }
        });

        $('#exampleModall').modal('show');
    }
</script>
