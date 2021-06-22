export default class AxiosWrapper {
    static async Get(endpoint) {
        try { 
            let results = await axios.get(endpoint);
            return results.data;
        } 
        catch(err) { handleError(err); }
    }
    
    static async Post(endpoint, json) {
        try { 
            let results = axios.post(endpoint, json, {'Content-Type': 'application/json' });
            return results.data;
        }
        catch(err) { handleError(err); }
    }

    static async Put(endpoint, json) {
        try { 
            let results = axios.put(endpoint, json, {'Content-Type': 'application/json' });
            return results.data;
        }
        catch(err) { handleError(err); }
    }

    static async Delete(endpoint) {
        try { 
            let results = axios.delete(endpoint);
            return results.data;
        }
        catch(err) { handleError(err); }
    }
}

function handleError(err)
{
    let response = "";

    switch(err.response.status) 
    {
        case 404:
            response = "Endpoint not found or you do not have the privileges to access this enpoint";
          break;
        case 400:
          response = err.response.data.Message;
          break;
        default:
          response = `Something went wrong.. Status Code: ${error.response.status} Report to Back end developer`;
    }
    throw response;
}