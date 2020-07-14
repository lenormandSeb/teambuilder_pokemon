class StatChanger {
    statsClass = ['statChangerStats', 'statChangerLVL', 'statChangerName']
    baseLvl = [50,100]
    constructor(hp, atk, def, speatk, spedef, speed) {
        this.statsArray = {
            'hp' : hp,
            'attack' : atk,
            'defense' : def,
            'spe_attack' : speatk,
            'spe_defense' : spedef,
            'speed' : speed
        }
    };

    getStatClass(value) {
        return this.statsClass[value];
    };

    getLvl() {
        return this.lvl;
    };

    setLVL(value) {
        this.lvl = value
    }

    autoInit() {
        // check if class exist
        for (var c in this.statsClass) {
            if (document.getElementsByClassName(this.statsClass[c]).length === 0) {
                throw new Error(`Class ${this.statsClass[c]} is missing`);
            }
        }
        
        // create node table
        for (var stat in this.statsArray) {
            this.createNode(stat, this.statsArray[stat]);
        }

        // create node lvl
        var e = document.getElementsByClassName(this.statsClass[1])[0];
        e.classList.add('radio')
        for(var lvl in this.baseLvl) {
            var label = document.createElement('label')
            label.classList.add('radio-inline')
            label.innerHTML = this.baseLvl[lvl]
            var input = document.createElement('input')
            input.setAttribute('type', 'radio')
            input.setAttribute('name', 'lvl')
            input.setAttribute('value', this.baseLvl[lvl])
            input.addEventListener('change', this.changeLvlPokemon)
            if(this.baseLvl[lvl] === 50) {
                input.setAttribute('checked', 'checked')
            }
            label.appendChild(input)
            e.appendChild(label)
        }

        document.getElementsByClassName(this.statsClass[2])[0].addEventListener('change', this.test)
    }

    createNode(property, value) {
        var tr = document.createElement('tr');
        tr.setAttribute('class',property);
        for(var i = 0 ; i < 5; i++) {
            var td = document.createElement('td');
            var input = document.createElement('input');
            input.addEventListener('change', this.update);
            input.setAttribute('class', 'form-control stat');
            input.setAttribute('type', 'number');
            input.setAttribute('min', 0);
            if (i === 0) {
                td.innerHTML = property;
                tr.appendChild(td);
            }
            else if (i === 1) {
                td.innerHTML = value;
                tr.appendChild(td);
            }
            else if (i === 2) {
                input.setAttribute('max', 255);
                input.setAttribute('value', 0);
                input.setAttribute('id', property + '-EV');
                td.appendChild(input);
                tr.appendChild(td);
            }
            else if (i === 3) {
                input.setAttribute('max', 31);
                input.setAttribute('value', 31);
                input.setAttribute('id', property + '-IV');
                td.appendChild(input);
                tr.appendChild(td);
            }
            else if (i === 4) {
                switch(property) {
                    case 'hp' :
                        td.innerHTML = this.PVCalculator(value, (typeof this.lvl != 'undefined') ? this.lvl : 50, 0, 31);
                    break;
                    default:
                        td.innerHTML = this.StatCalculator(value, (typeof this.lvl != 'undefined') ? this.lvl : 50, 0, 31, 1);
                    break;
                }
                tr.appendChild(td);
            }

        }
        document.getElementsByClassName(this.statsClass[0])[0].appendChild(tr);
    }

    update(event, lvl = null, aug = null, down = null) {
        if (event === 'updateByLvl' || event === 'updateByNature') {
            //recuperation des valeurs
            var allTR = document.getElementsByClassName('statChangerStats')[0].children
            for (var x in allTR) {
                if (allTR[x].childNodes != undefined) {
                    var bs = allTR[x].childNodes[1].innerHTML 
                    var ev = allTR[x].childNodes[2].children[0].value
                    var iv = allTR[x].childNodes[3].children[0].value
                    if (allTR[x].childNodes[0].innerHTML === 'hp') {
                        resultat = StatChanger.prototype.PVCalculator(bs, lvl, ev, iv)
                    } else {
                        var nat = "1";
                        if (aug == allTR[x].childNodes[0].innerHTML) {
                            nat = "1.1";
                        }
                        if (down == allTR[x].childNodes[0].innerHTML) {
                            nat = "0.9"
                        }

                        resultat = StatChanger.prototype.StatCalculator(bs, lvl, ev, iv, nat)
                    }
                    allTR[x].childNodes[4].innerHTML = resultat
                }
            }
        } else {
            var iv, ev, bs, resultat, str, parentTR
            str = event.target.getAttribute('id').replace(/(-\D{2})/, '')
            parentTR = document.getElementsByClassName(str)[0]
            bs = parentTR.children[1].innerHTML
            if (event.target.getAttribute('id').includes('-IV')) {
                iv = event.target.value
                ev = parentTR.children[2].children[0].value
            } else {
                ev = event.target.value
                iv = parentTR.children[3].children[0].value
            }

            switch (str) {
                case 'hp':
                    resultat = StatChanger.prototype.PVCalculator(bs, (typeof lvl != 'undefined') ? StatChanger.prototype.getLvl() : 50, ev, iv)
                break;
                default:
                    resultat = StatChanger.prototype.StatCalculator(bs, (typeof lvl != 'undefined') ? StatChanger.prototype.getLvl() : 50, ev, iv, 1);
                break;
            }
            
            parentTR.lastElementChild.innerHTML = resultat;
        }
    };

    changeLvlPokemon(e) {
        StatChanger.prototype.setLVL(e.currentTarget.value)
        StatChanger.prototype.update('updateByLvl', e.currentTarget.value)
    };

    StatCalculator(stat, niv, ev, iv, nat) {
        var calc = ((parseInt(iv) + 2 * parseInt(stat) + Math.floor(parseInt(ev) / 4)) * (parseInt(niv) / 100) + 5) * parseFloat(nat)
        return Math.floor(calc)
    };

    PVCalculator(hp, niv, ev, iv) {
        var calc = (parseInt(iv) + 2 * parseInt(hp) + Math.floor(parseInt(ev) / 4)) * (parseInt(niv) / 100) + 10 + parseInt(niv)
        return Math.floor(calc)
    };

    test(e) {
        StatChanger.prototype.update('updateByNature', 50, 'attack', 'defense')
    }
}