const obj = [{
    'name': 'anna',
    'lastname': 'petrova'
},
    {
        'name': 'vika',
        'lastname': 'ivanova'
    },
    {
        'name': 'julia',
        'lastname': 'petrova'
    },
];

const res = obj.reduce((o, i) => {
    if (!o.find(v => v.lastname == i.lastname)) {
        o.push(i);
    }
    return o;
}, []);
console.log(res)