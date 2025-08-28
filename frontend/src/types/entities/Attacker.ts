import type { Country } from '@/types/entities/Country.ts';

export interface Attacker {
  id: number;
  ipv4: string;
  description?: string;
  country: Country;
}
