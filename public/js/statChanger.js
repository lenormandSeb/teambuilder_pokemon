class Test {
    constructor(hp, atk, def, atkspe, defspe, vit) {
        this.hp = hp;
        this.atk = atk;
        this.def = def;
        this.atkspe = atkspe;
        this.defspe = defspe;
        this.vit = vit;
    };
    calculateur() {
        $('#hpfinal').html(this.PVCalculator(this.hp, 50, 0, 31))
        $('#atkfinal').html(this.StatCalculator(this.atk, 50, 0, 31))
        $('#deffinal').html(this.StatCalculator(this.def, 50, 0, 31))
        $('#atkspefinal').html(this.StatCalculator(this.atkspe, 50, 0, 31))
        $('#defspefinal').html(this.StatCalculator(this.defspe, 50, 0, 31))
        $('#vitfinal').html(this.StatCalculator(this.vit, 50, 0, 31))
    };
    update(text) {
        if ($(text).attr('name') === 'hpEV' || $(text).attr('name') === 'hpIV') {
            var newstat = this.PVCalculator(this.hp, 100, parseInt($('.hpEV').val()), parseInt($('.hpIV').val()))
            $('#hpfinal').html(newstat);
        } else {
            if ($(text).attr('name') == 'atkEV' || $(text).attr('name') == 'atkIV') {
                var newstat = this.StatCalculator(this.atk, 100, )
            }
            else if ($(text).attr('name') === 'defEV' || $(text).attr('name') == 'defIV') {
                console.log('def')
            }
            else if ($(text).attr('name') === 'atkspeEV' || $(text).attr('name') == 'atkspeIV') {

            }
            else if ($(text).attr('name') === 'defspeEV' || $(text).attr('name') == 'defspeIV') {

            }
            else if ($(text).attr('name') === 'vitEV' || $(text).attr('name') == 'vitIV') {

            }
        }
    };
    StatCalculator(stat, niv, ev, iv) {
        var calc = ((iv + 2 * stat + Math.floor(ev / 4)) * (niv / 100) + 5) * 1
        return Math.floor(calc)
    };
    PVCalculator(hp, niv, ev, iv) {
        var calc = (iv + 2 * hp + Math.floor(ev / 4)) * (niv / 100) + 10 + niv
        return Math.floor(calc)
    }
}