import axios from 'axios';
import { apiConfig } from '@/api/config.js';

axios.defaults.baseURL = apiConfig.url;
