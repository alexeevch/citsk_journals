import { useCookies } from 'vue3-cookies';
import axios from 'axios';

class AuthService {
  #instance = null;
  #cookie = null;
  #accessTokenKey = 'access_token';
  #refreshTokenKey = 'refresh_token';

  constructor() {
    if (this.#instance) {
      return this.#instance;
    }

    this.#cookie = useCookies().cookies;
    this.#instance = this;
  }

  hasCookie() {
    return Boolean(this.#cookie.get(this.#accessTokenKey));
  }

  logout() {
    this.#cookie.remove(this.#accessTokenKey);
  }

  async loginAsync(login, password) {
    try {
      const { data } = await axios.post('/auth/login', { login, password }).data;
      this.#cookie.set(this.#accessTokenKey, data.access_token);
    } catch (e) {
      await Promise.reject(e);
    }
  }

  async refreshTokenAsync(refresh_token) {
    try {
      const { data } = await axios.post('/auth/refresh', { refresh_token }).data;
      this.#cookie.set(this.#accessTokenKey, data.access_token);
      this.#cookie.set(this.#refreshTokenKey, data.refresh_token);
    } catch (e) {
      await Promise.reject(e);
    }
  }
}

const authService = new AuthService();

export default authService;
