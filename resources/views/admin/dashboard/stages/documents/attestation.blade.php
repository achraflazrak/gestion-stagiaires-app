<div style="display:flex; flex-direction:column; justify-content:center; align-items:center;">
    <div style="border: 1px solid #000; border-radius: 15px; width: 1000px; padding: 30px 30px 0px 30px; margin-right: 20px; height: 670px">
        <div style="height: 130px; display:flex; justify-content:center; align-items:center; text-align:center">
            <img style="border-radius: 10px" src="{{'data:image/png;base64,'.base64_encode(file_get_contents(public_path('images/logo_ministere_education_nationale.png')))}}">
        </div>
        <div style="border: 2px solid #000; border-radius: 15px; padding: 7px; margin: 0px 50px">
                <h2 style="font-family: Arial, Helvetica, sans-serif; text-align:center;">Attestation de stage</h2>
            </div>
            <div>
                <pre style="font-size: 14px; margin-top: 20px; height: 360px">
                        Je sousigné, {{ $admin->sexe == 'm'? 'M' : 'Mme'  }} {{ Str::upper($admin->prenom) }} {{ Str::upper($admin->nom) }} chef division du Centre Informatique au sein de
                la <strong><i>Direction du Système d'Information,</i></strong> atteste que {{ $stg->sexe == 'm'? 'Monsieur' : 'Madame' }}: <strong>{{ Str::upper($stg->nom) }} {{ Str::upper($stg->prenom) }}</strong> a éffectué
                un stage au sein de notre service d'une durée<strong> {{ $offre->duree >= 30? Str::of($offre->duree/30).' mois' : Str::of($offre->duree) .' jours'  }} : de {{ \Carbon\Carbon::parse($offre->date_debut)->format('d/m/Y') }} au {{ \Carbon\Carbon::parse($offre->date_debut)->addDays($offre->duree)->format('d/m/Y') }}.</strong>

                Par sa rigueur et ses qualités professionelles et humaines, {{ $stg->sexe == 'm'? 'Monsieur' : 'Madame' }} <strong>{{ Str::upper($stg->nom) }} {{ Str::upper($stg->prenom) }}</strong>
                a su trouver sa place au sein de l'équipe. Sa présence a été satisfaisante à trois points de vue.

                En foi de quoi, la présente attestation est délivrée à l'intéressé pour servir et valoir ce que
                de droit.
                </pre>
            </div>
            <hr style="border-bottom: none;" />
            <div style="text-align: center">
                Direction du Système d'Information {{ \Carbon\Carbon::now()->format('Y') }}
                <br />
                site web: <span style="text-decoration: underline">http://www.men.gov.ma</span>
            </div>
    </div>
</div>
