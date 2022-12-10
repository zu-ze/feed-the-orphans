import { useSelector } from "react-redux"
export const emailValidator = (email) => {
  const re = /\S+@\S+\.\S+/;

  if (!email || email.length <= 0) return 'Email cannot be empty.';
  if (!re.test(email)) return 'Ooops! We need a valid email address.';

  return '';
};

export const passwordValidator = (password) => {
  if (!password || password.length <= 0) return 'Password cannot be empty.';

  return '';
};

export const nameValidator = (name) => {
  if (!name || name.length <= 0) return 'Field cannot be empty.';

  return '';
};

export const amountValidator = (value) => {
  if (!value || value.length <= 0) return 'Field cannot be empty.';
  if (parseInt(value) <= 1000) return 'Field should be more than MK1,000';
  if (parseInt(value) > 751000) return 'Field should not be more than MK750,000';
}

export const airtelTransValidator = (transId) => {
  const re = /\S+.\S+.\S+/;

  if (!transId || transId.length <= 0 ) return 'Field cannot be empty.';
  if (!re.test(transId) || transId.length < 18 ) return 'Ooops! This is not a valid transation Id.';
  
  return '';
}

export const mpambaTransValidator = (transId) => {
  const re = /[ `!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/;

  if (!transId || transId.length <= 0) return 'Field cannot be empty.';
  if (re.test(transId) || transId.length < 10) return 'Ooops! This is not a valid transation Id.';

  return '';
}

export const post = async (url, body, ...props) => {
  try {
    const response = await fetch(
      url, {
        method: "POST",
        headers: {
          Accept: "application/json",
          "Content-Type": "application/json"
        },
        body: JSON.stringify(body)
      }
    );

    const json = await response.json();

    return json;
  } catch(error) {
    console.error(error);
    return false;
  }
};

export const get = async (url, body = false, ...props) => {
  const dataStr = '';
  if (body) {
    for ( key in body) {
      if (body.hasOwnProperty(key)) {
        dataStr += key + '=' + body[key] + ';';
      }
    }
    url += '?' + dataStr;
  }

  try {
    const response = await fetch(url);
    const json = await response.json();
    return json;
  } catch(error) {
    console.error(error);
    return false;
  }
};
