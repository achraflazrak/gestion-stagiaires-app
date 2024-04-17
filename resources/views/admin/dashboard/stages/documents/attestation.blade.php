<div style="display:flex; flex-direction:column; justify-content:center; align-items:center; margin-top: 30px">
    <div style="border: 1px solid #000; border-radius: 15px; width: 900px; padding: 30px 30px 130px 30px; margin-left: 30px">
        <div style="border: 2px solid #000; border-radius: 15px; padding: 5px; margin: 0px 20px">
                <h2 style="font-family: Arial, Helvetica, sans-serif; text-align:center;">Attestation de stage</h2>
            </div>
            <div>
                <pre style="font-size: 16px; margin: 30px 0">
                            Nous sousignées, la Direction du Système de l'information
                    du Ministère de l'éducation Nationale, du Préscolaire & des Sports
                    que: {{ Str::ucfirst($stg->nom) }} {{ Str::ucfirst($stg->prenom) }} a éffectué un stage au sein de notre Direction

                    Cette attestation est délivrée à l'intéressé(e) pour servir et valoir
                    de droit
                </pre>
            </div>
    </div>
</div>
