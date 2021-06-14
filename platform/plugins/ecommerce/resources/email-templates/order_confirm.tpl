{{ header }}

<h2>Cảm ơn bạn đã đặt hàng của chúng tôi!</h2>

<p>Xin chào {{ customer_name }},</p>

<p>Chúng tôi xác nhận đơn hàng của bạn</p>
<br />

<h3>Thông tin đơn hàng: </h3>

<p>mã đơn hàng: <strong>#{{ order_id }}</strong></p>

{{ product_list }}

<h3>Thông tin khách hàng</h3>

<p>{{ customer_name }} - {{ customer_phone }}, {{ customer_address }}</p>
<br />

{{ footer }}
