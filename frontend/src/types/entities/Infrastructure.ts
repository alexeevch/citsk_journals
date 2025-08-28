import type { Owner } from '@/types/entities/Owner.ts';

export interface Infrastructure {
  id: number;
  ipv4: string;
  name: string;
  owner: Owner;
}
