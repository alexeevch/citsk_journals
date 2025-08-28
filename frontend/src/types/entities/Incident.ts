import type { Attacker } from '@/types/entities/Attacker.ts';
import type { Infrastructure } from '@/types/entities/Infrastructure.ts';
import type { Dictionary } from '@/types/entities/Common.ts';

export interface Incident {
  id: number;
  attacker: Attacker;
  infrastructure: Infrastructure;
  type: Dictionary;
  status: Dictionary;
  description?: string;
  detection_at: string;
  group_notified_at: string;
  supervisor_notified_at: string;
}
