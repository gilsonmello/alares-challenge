import axios from 'axios';

export const apiInstance = axios.create({
  baseURL: process.env.NEXT_PUBLIC_API_BASEURL,
});

apiInstance.interceptors.request.use(async (reqConfig) => {
  return reqConfig;
});

apiInstance.interceptors.response.use(
  (response) => {
    return Promise.resolve(response);
  },
  (error) => {
    return Promise.reject(error);
  },
);