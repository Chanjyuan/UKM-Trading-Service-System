<link rel="stylesheet" href="{{ asset('css/card.css') }}">
 
<form method="POST" action="{{ url('payment') }}">
    {{ csrf_field() }}
    <div class="form-container">
        <div class="personal-information">
            <h1>Payment Information</h1>
        </div> <!-- end of personal-information -->
          
        <input id="column-left" type="text" name="first-name" placeholder="First Name" required="required" />
        <input id="column-right" type="text" name="last-name" placeholder="Surname" required="required" />
        <input id="input-field" type="text" name="number" placeholder="Card Number" required="required" />
        <input id="column-left" type="text" name="expiry" placeholder="MM / YY" required="required" />
        <input id="column-right" type="text" name="cvc" placeholder="CCV" required="required" />
 
        <div class="card-wrapper"></div>
 
        <input id="input-field" type="text" name="streetaddress" required="required" autocomplete="on" maxlength="45" placeholder="Streed Address"/>
        <input id="column-left" type="text" name="city" required="required" autocomplete="on" maxlength="20" placeholder="City"/>
        <input id="column-right" type="text" name="zipcode" required="required" autocomplete="on" pattern="[0-9]*" maxlength="5" placeholder="ZIP code"/>
        <input id="input-field" type="email" name="email" required="required" autocomplete="on" maxlength="40" placeholder="Email"/>
        <input id="input-field" type="text" name="amount" required="required" autocomplete="on" maxlength="40" placeholder="Amount"/>
        <input id="input-button" name="submit" type="submit" value="Submit"/>
    </div>
</form>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="{{ asset('js/jquery.card.js') }}"></script>
<script src="{{ asset('js/card.js') }}"></script>