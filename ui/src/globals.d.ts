export {};

declare global {
  interface Window {
    openemrData?: {
      user_id: number;
      base_url: string;
      csrf_token: string;
      language: string;
      site_id: string;
      dev_mode?: boolean;
    };
  }
}
