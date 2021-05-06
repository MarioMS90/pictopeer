export interface Activity {
  id: number;
  name: string;
  description: string;
  inscription_date_start: number;
  inscription_date_end: number;
  type: string;
  paymethod: string;
  prices: ActivityPrice[];
  enrollees: ActivityEnrollees[];
}

export interface ActivityPrice {
  id: number;
  name: string;
  amount: number;
}

export interface ActivityEnrollees {
  id: number;
  license: number;
  name: string;
  pay_date: number;
  price_name: string;
  price: number;
  paymethod: string;
  status: string;
}

export interface ActivityType {
  id: number;
  activity_type: string;
}
