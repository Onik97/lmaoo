export default class AxiosWrapper {

    static async QuickGetRequest(endpoint, functionValue, dataKey, dataValue) {
        var data = new FormData();
        data.append("function", functionValue);
        data.append(dataKey, dataValue);

        try { 
            return await axios.get(endpoint, data, {'Content-Type': 'multipart/form-data' }); 
        }
        catch(err) { 
            console.log(err); 
        }
    }
    
    static async QuickPostRequest(endpoint, functionValue, dataKey, dataValue) {
        var data = new FormData();
        data.append("function", functionValue);
        data.append(dataKey, dataValue);

        try { 
            return await axios.post(endpoint, data, {'Content-Type': 'multipart/form-data' }); 
        }
        catch(err) { 
            console.log(err); 
        }
    }
}