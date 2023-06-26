<style>
    body{
        direction:rtl;
        font-family: 'b yekan','tahoma';
    }
    table{
        font-size: 13px;
    }
    table td{
        line-height: 30px;
    }
    table th{
        line-height: 30px;
        text-align: center;
    }
    .order_header{
        float: right;

    }
    .order_header .order_title{

    }
    .order_header .order_date{

    }
    .site_logo{
        float: left;
    }
    .site_logo img{
        height: 40px;
    }
    .bold{
        font-weight: bold;
    }
    .border{
        border: 1px solid #63b4da;
    }
    .border_top{
        border-top: 1px solid #63b4da;
    }
    .border_right{
        border-right: 1px solid #63b4da;
    }
    .order_detail td{
        border-top: 1px solid #63b4da;
        text-align: center;
    }
    .order_detail th{
        background: #cedfee;
    }
    .width50{
        border-spacing: 0;
        border-collapse: 0;
        width: 50%;
    }
    .width100{
        border-spacing: 0;
        border-collapse: 0;
        width: 100%;
    }
    .width80{
        border-spacing: 0;
        border-collapse: 0;
        width: 80%;
    }
    .padding_right{
        padding-right: 5px;
    }
    .padding_left{
        padding-left: 5px;
    }
    .left{
        float: left;
    }
    a{
        text-decoration: none;
        color: #2fa9f2;
    }
</style>
<table class="width80 border " cellpadding="0" cellspacing="0" align="center">
    <tr>
        <td colspan="2" class="padding_right">
            <div class="order_header">
                <div class="order_title">
                    <span class="bold">@lang('order.order_code') :</span>
                    <span >   {{$order->code}} </span>
                </div>
                <div class="order_date">
                    <span class="bold">@lang('order.order_date') :</span>
                    <span>{{ $order->created_at }}</span>
                </div>
            </div>
            <div class="site_logo padding_left">
                <img src="{{ frontendTheme('images/logo.png') }}" />
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <table class="width100 border_top padding_right">
                <tr>
                    <td>
                        <span class="bold"> @lang('order.recipient_name') :</span>
                        <span > {{ $order->user_detail->recipient_name }} </span>
                    </td>
                    <td>
                        <span class="bold"> @lang('order.telephon') :</span>
                        <span > {{ $order->user_detail->telephon }} </span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span class="bold"> @lang('order.post_code')  :</span>
                        <span > {{ $order->user_detail->post_code }} </span>
                    </td>
                    <td>

                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <span class="bold"> @lang('order.address') :</span>
                        <span >
							 {{ $order->user_detail->address }}
						</span>
                    </td>
                </tr>
            </table>
        </td>
        <td>
            <table class="width100 border_top border_right padding_right">

            </table>
        </td>
    </tr>
    <tr>
        <td colspan="2" class="border_top">
            <table class="width100 order_detail">
                <tr>
                    <th width="5%"> ردیف</th>
                    <th class="border_right" width="45%">@lang('textile.title') </th>
                    <th class="border_right" width="20%">@lang('textile.price') </th>
                    <th class="border_right" width="10%">@lang('order.item_count')</th>
                    <th class="border_right" width="20%">@lang('order.sum_price')</th>
                </tr>
                <?php
                $i=1;
                if(!empty($orderItems)){
                    $item_count=0;
                    $sum_price=0;
                    foreach($orderItems as $orderItem){
                        $item_count += $orderItem->item_count;
                        $sum_price += $orderItem->sum_price;
                        echo "
						     <tr>
								<td>".$i."</td>
								<td class='border_right'>".$orderItem->textile->title."</td>
								<td class='border_right'>".number_format($orderItem->textile->price).' '.__('message.rial')."</td>
								<td class='border_right'>".$orderItem->item_count."</td>
								<td class='border_right'>".number_format($orderItem->sum_price).' '.__('message.rial')."</td>
							</tr>
						  ";
                        $i++;
                    }
                }
                ?>
            </table>
        </td>
    </tr>
</table>
<br />
<table class="width80  " cellpadding="0" cellspacing="0" align="center">
    <tr><td>

            <table cellpadding="0" cellspacing="0" class="left order_detail border ">
                <tr>
                    <th class="border_right" width="10%">@lang('order.sum_count')</th>
                    <th class="border_right" width="20%">@lang('order.sum_price')</th>
                </tr>
                <tr >
                    <td class="border_right"><?php echo $item_count; ?></td>
                    <td class="border_right"><?php echo number_format($sum_price).' '.__('message.rial'); ?></td>
                </tr>
            </table>

        </td></tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>
            <span>در صورت بروز هرگونه مشکل از طریق صفحه &nbsp;</span><a href="/contactus">تماس با ما</a>
            <span> با مدیر سایت تماس بگیرید.</span>
        </td>
    </tr>
</table>
<?php
/*pr($user);
pr($order_id);
pr($orderItems);
pr($user_details);*/

?>
<script>
    window.print();
</script>
