function customSerializeFormDataUpdate(data, keys, value, onlyObjects = false) {
    if (keys.length === 0) {
        return value;
    }

    let key = keys.shift();
    if (!key) {
        data = data || [];
        if (Array.isArray(data)) {
            key = data.length;
        }
    }

    let index = +key;
    if (!isNaN(index)) {
        data = data || (onlyObjects ? {} : []);
        key = index;
    }

    data = data || {};
    if (!!value) {
        if (onlyObjects && typeof key !== 'string') {
            key = key.toString();
        }
        data[key] = customSerializeFormDataUpdate(data[key], keys, value, onlyObjects);
    }
    return data;
}
function customSerializeFormData(form, onlyObjects = false) {
    let formData = new FormData(form);
    return Array.from(formData.entries())
        .reduce((data, [field, value]) => {
            let [_, prefix, keys] = field.match(/^([^\[]+)((?:\[[^\]]*\])*)/);
            if (keys) {
                keys = Array.from(keys.matchAll(/\[([^\]]*)\]/g), m => m[1]);
                value = customSerializeFormDataUpdate(data[prefix], keys, value, onlyObjects);
            }
            data[prefix] = value;
            return data;
        }, {});
}

// usage
// $(form).on('submit', function() {
//     let data = customSerializeFormData(this, false);
// });