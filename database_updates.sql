-- Add columns to pengerjaan table for submit tugas functionality
-- Note: foto_before and foto_after will store JSON arrays for multiple tasks
ALTER TABLE pengerjaan 
ADD COLUMN foto_before TEXT NULL AFTER standar,
ADD COLUMN foto_after TEXT NULL AFTER foto_before,
ADD COLUMN catatan TEXT NULL AFTER foto_after,
ADD COLUMN completed_at DATETIME NULL AFTER catatan;
