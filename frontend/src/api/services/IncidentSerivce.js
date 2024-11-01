import axios from 'axios';

export class IncidentSerivce {
  static async getAll() {
    try {
      const { data } = await axios.get('/incident');
      return data.data;
    } catch (e) {
      await Promise.reject(e);
    }
  }

  static async getById(id) {
    try {
      const { data } = await axios.get(`/incident${id}`);
      return data.data;
    } catch (e) {
      await Promise.reject(e);
    }
  }

  static async create(incident) {
    try {
      const { data } = await axios.post(`/incident`, incident);

      return data.data;
    } catch (e) {
      await Promise.reject(e);
    }
  }

  static async update(incident) {
    try {
      const { data } = await axios.patch(`/incident`, incident);

      return data.data;
    } catch (e) {
      await Promise.reject(e);
    }
  }

  static async delete(id) {
    try {
      const { data } = await axios.patch(`/incident${id}`);

      return data.data;
    } catch (e) {
      await Promise.reject(e);
    }
  }
}
