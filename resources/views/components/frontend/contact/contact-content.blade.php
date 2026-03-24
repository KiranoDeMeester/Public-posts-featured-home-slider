<div class="row">
    <div class="col-12 col-lg-5">
        <div class="contact-info-area mb-100">
            <h2 class="font-pt mb-50">Onze Redactie</h2>
            <p>Heb je een tip voor de redactie of wil je adverteren op Gazette? Neem gerust contact met ons op via onderstaande gegevens of het formulier.</p>
            <div class="single-contact-info d-flex align-items-center mt-30">
                <div class="icon mr-15"><i class="fa fa-map-marker"></i></div>
                <p>Stationsstraat 100, 8800 Roeselare</p>
            </div>
            <div class="single-contact-info d-flex align-items-center">
                <div class="icon mr-15"><i class="fa fa-phone"></i></div>
                <p>+32 51 12 34 56</p>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-7">
        <div class="contact-form-area mb-100">
            <form action="#" method="post">
                @csrf
                <div class="row">
                    <div class="col-12 col-md-6 mb-3"><input type="text" class="form-control" placeholder="Je Naam"></div>
                    <div class="col-12 col-md-6 mb-3"><input type="email" class="form-control" placeholder="Je E-mail"></div>
                    <div class="col-12 mb-3"><textarea name="message" class="form-control" cols="30" rows="10" placeholder="Je bericht..."></textarea></div>
                    <div class="col-12"><button type="submit" class="btn btn-dark">Verstuur</button></div>
                </div>
            </form>
        </div>
    </div>
</div>
