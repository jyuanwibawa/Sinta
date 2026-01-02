-- ========================================
-- Add timestamp columns to existing ruangan table
-- ========================================

-- Add created_at column if it doesn't exist
ALTER TABLE ruangan 
ADD COLUMN IF NOT EXISTS created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP;

-- Add updated_at column if it doesn't exist  
ALTER TABLE ruangan 
ADD COLUMN IF NOT EXISTS updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP;

-- Update existing records to have timestamps
UPDATE ruangan SET 
    created_at = NOW(),
    updated_at = NOW() 
WHERE created_at IS NULL;

-- ========================================
-- Verify table structure
-- ========================================

DESCRIBE ruangan;
