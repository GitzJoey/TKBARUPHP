<?php

/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 9/10/2016
 * Time: 11:11 AM
 */
use Illuminate\Database\Seeder;

use App\Model\PhonePrefix;
use App\Model\PhoneProvider;

class PhoneProviderTableSeeder extends Seeder
{
    public function run()
    {
        /* TSEL */
        $pp_tsel = new PhoneProvider();
        $pp_tsel->name = 'Telkomsel';
        $pp_tsel->short_name = 'T-SEL';
        $pp_tsel->status = 'STATUS.ACTIVE';
        $pp_tsel->remarks = '';
        $pp_tsel->save();

        $ppx_tsel_0811 = new PhonePrefix();
        $ppx_tsel_0811->prefix = '0811';
        $pp_tsel->prefixes()->save($ppx_tsel_0811);

        $ppx_tsel_0812 = new PhonePrefix();
        $ppx_tsel_0812->prefix = '0812';
        $pp_tsel->prefixes()->save($ppx_tsel_0812);

        $ppx_tsel_0813 = new PhonePrefix();
        $ppx_tsel_0813->prefix = '0813';
        $pp_tsel->prefixes()->save($ppx_tsel_0813);

        $ppx_tsel_0821 = new PhonePrefix();
        $ppx_tsel_0821->prefix = '0821';
        $pp_tsel->prefixes()->save($ppx_tsel_0821);

        $ppx_tsel_0822 = new PhonePrefix();
        $ppx_tsel_0822->prefix = '0822';
        $pp_tsel->prefixes()->save($ppx_tsel_0822);

        $ppx_tsel_0823 = new PhonePrefix();
        $ppx_tsel_0823->prefix = '0823';
        $pp_tsel->prefixes()->save($ppx_tsel_0823);

        $ppx_tsel_0852 = new PhonePrefix();
        $ppx_tsel_0852->prefix = '0852';
        $pp_tsel->prefixes()->save($ppx_tsel_0852);

        $ppx_tsel_0853 = new PhonePrefix();
        $ppx_tsel_0853->prefix = '0853';
        $pp_tsel->prefixes()->save($ppx_tsel_0853);

        $ppx_tsel_0851 = new PhonePrefix();
        $ppx_tsel_0851->prefix = '0851';
        $pp_tsel->prefixes()->save($ppx_tsel_0851);

        /* XL */
        $pp_xl = new PhoneProvider();
        $pp_xl->name = 'XL';
        $pp_xl->short_name = 'XL';
        $pp_xl->status = 'STATUS.ACTIVE';
        $pp_xl->remarks = '';
        $pp_xl->save();

        $ppx_xl_0817 = new PhonePrefix();
        $ppx_xl_0817->prefix = '0817';
        $pp_xl->prefixes()->save($ppx_xl_0817);

        $ppx_xl_0818 = new PhonePrefix();
        $ppx_xl_0818->prefix = '0818';
        $pp_xl->prefixes()->save($ppx_xl_0818);

        $ppx_xl_0819 = new PhonePrefix();
        $ppx_xl_0819->prefix = '0819';
        $pp_xl->prefixes()->save($ppx_xl_0819);

        $ppx_xl_0859 = new PhonePrefix();
        $ppx_xl_0859->prefix = '0859';
        $pp_xl->prefixes()->save($ppx_xl_0859);

        $ppx_xl_0877 = new PhonePrefix();
        $ppx_xl_0877->prefix = '0877';
        $pp_xl->prefixes()->save($ppx_xl_0877);

        $ppx_xl_0878 = new PhonePrefix();
        $ppx_xl_0878->prefix = '0878';
        $pp_xl->prefixes()->save($ppx_xl_0878);

        /* ISAT */
        $pp_isat = new PhoneProvider();
        $pp_isat->name = 'Indosat';
        $pp_isat->short_name = 'ISAT';
        $pp_isat->status = 'STATUS.ACTIVE';
        $pp_isat->remarks = '';
        $pp_isat->save();

        $ppx_isat_0855 = new PhonePrefix();
        $ppx_isat_0855->prefix = '0855';
        $pp_isat->prefixes()->save($ppx_isat_0855);

        $ppx_isat_0856 = new PhonePrefix();
        $ppx_isat_0856->prefix = '0856';
        $pp_isat->prefixes()->save($ppx_isat_0856);

        $ppx_isat_0855 = new PhonePrefix();
        $ppx_isat_0855->prefix = '0855';
        $pp_isat->prefixes()->save($ppx_isat_0855);

        $ppx_isat_0857 = new PhonePrefix();
        $ppx_isat_0857->prefix = '0857';
        $pp_isat->prefixes()->save($ppx_isat_0857);

        $ppx_isat_0858 = new PhonePrefix();
        $ppx_isat_0858->prefix = '0858';
        $pp_isat->prefixes()->save($ppx_isat_0858);

        $ppx_isat_0814 = new PhonePrefix();
        $ppx_isat_0814->prefix = '0814';
        $pp_isat->prefixes()->save($ppx_isat_0814);

        $ppx_isat_0815 = new PhonePrefix();
        $ppx_isat_0815->prefix = '0815';
        $pp_isat->prefixes()->save($ppx_isat_0815);

        $ppx_isat_0816 = new PhonePrefix();
        $ppx_isat_0816->prefix = '0816';
        $pp_isat->prefixes()->save($ppx_isat_0816);

        /* TLKM */
        $pp_tlkm = new PhoneProvider();
        $pp_tlkm->name = 'Telkom';
        $pp_tlkm->short_name = 'TLKM';
        $pp_tlkm->status = 'STATUS.ACTIVE';
        $pp_tlkm->remarks = '';
        $pp_tlkm->save();

        $ppx_tlkm_0281 = new PhonePrefix();
        $ppx_tlkm_0281->prefix = '0281';
        $pp_tlkm->prefixes()->save($ppx_tlkm_0281);

        $ppx_tlkm_021 = new PhonePrefix();
        $ppx_tlkm_021->prefix = '021';
        $pp_tlkm->prefixes()->save($ppx_tlkm_021);

        $ppx_tlkm_022 = new PhonePrefix();
        $ppx_tlkm_022->prefix = '022';
        $pp_tlkm->prefixes()->save($ppx_tlkm_022);

        $ppx_tlkm_0231 = new PhonePrefix();
        $ppx_tlkm_0231->prefix = '0231';
        $pp_tlkm->prefixes()->save($ppx_tlkm_0231);

        $ppx_tlkm_0286 = new PhonePrefix();
        $ppx_tlkm_0286->prefix = '0286';
        $pp_tlkm->prefixes()->save($ppx_tlkm_0286);
    }
}