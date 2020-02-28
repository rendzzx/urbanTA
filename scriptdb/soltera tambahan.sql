CREATE view [mgr].[v_nup_summary_lnd] as
SELECT
	CONVERT(VARCHAR, nup_date, 103) AS nup_date
	,COUNT(qty) AS unit
	,entity_cd
	,project_no
	,nup_type
	,nup_descs
	,status_nup
	,nup_date as nupDate
FROM mgr.v_reserve_nup
WHERE product_cd = 'LND'
GROUP BY	nup_descs
			,nup_type
			,status_nup
			,nup_date
			,entity_cd
			,project_no
CREATE view [mgr].[v_nup_summary_apt] as
SELECT
	CONVERT(VARCHAR, nup_date, 103) AS nup_date
	,COUNT(qty) AS unit
	,entity_cd
	,project_no
	,nup_type
	,nup_descs
	,status_nup
	,nup_date as nupDate
FROM mgr.v_reserve_nup(nolock)
WHERE product_cd = 'APT'
GROUP BY	nup_descs
			,nup_type
			,status_nup
			,nup_date
			,entity_cd
			,project_no
CREATE view [mgr].[v_reserve_nup] as


select  entity_cd = r.entity_cd, 
	    project_no = r.project_no, 
		status_nup = 'A',
		business_id = r.business_id,
		business_name = c.name, 
		nup_date = cast( convert(varchar, r.reserve_date, 103) as datetime), 
		nup_no = r.nup_no,
		nup_amt = r.nup_amt,  
		qty = 1,
		product_cd = r.product_cd,
		product_descs = p.descs,
		product_type = r.product_type,
		product_type_descs = pd.descs,
		nup_type = r.nup_type,
		nup_descs =n.descs,
		phase_cd = r.phase_cd,
		phase_descs = ph.descs,
		lead_cd= mgr.cf_agent_hd.lead_cd,
		lead_name = mgr.cf_lead_agent.lead_name,
		group_cd = r.group_cd,
		group_type = mgr.cf_agent_hd.group_type,
		group_name = mgr.cf_agent_hd.group_name,
		agent_cd = r.agent_cd,
		agent_name = mgr.cf_agent_dt.agent_name,
		location_cd= r.location_cd,
		location_descs = l.descs
from mgr.rl_reserve_nup r  (nolock)
inner join mgr.cf_business c  (nolock)
on r.business_id = c.business_id
inner join mgr.pm_product p  (nolock)
on r.entity_cd = p.entity_cd
and r.project_no = p.project_no
and r.product_cd = p.product_cd
inner join mgr.pm_product_dtl pd  (nolock)
on r.entity_cd = pd.entity_cd
and r.project_no = pd.project_no
and r.product_cd = pd.product_cd
and r.product_type = pd.product_type
inner join mgr.rl_nup_type n  (nolock)
on r.entity_cd = n.entity_cd
and r.project_no = n.project_no
and r.product_cd = n.product_cd
and r.nup_type = n.nup_type
inner join mgr.rl_phase ph  (nolock)
on r.entity_cd = ph.entity_cd
and r.project_no = ph.project_no
and r.phase_cd = ph.phase_cd
inner join mgr.cf_location l (nolock)
on l.location_cd = r.location_cd
inner join mgr.cf_agent_hd (nolock)
on r.entity_cd = mgr.cf_agent_hd.entity_cd  and
   r.group_cd = mgr.cf_agent_hd.group_cd 
inner join mgr.cf_agent_dt (nolock)
on r.entity_cd = mgr.cf_agent_dt.entity_cd and
r.group_cd = mgr.cf_agent_dt.group_cd AND
r.agent_cd = mgr.cf_agent_dt.agent_cd 
left outer join mgr.cf_lead_agent (nolock)
on mgr.cf_agent_hd.entity_cd = mgr.cf_lead_agent.entity_cd and
mgr.cf_agent_hd.lead_cd = mgr.cf_lead_agent.lead_cd 
where  r.status in ('C','A','B')
union

select  entity_cd = r.entity_cd, 
	    project_no = r.project_no, 
		status_nup = 'U',
		business_id = r.business_id,
		business_name = c.name, 
		nup_date = cast( convert(varchar, r.reserve_date, 103) as datetime), 
		nup_no = r.nup_no,
		nup_amt = r.nup_amt,  
		qty = 1,
		product_cd = r.product_cd,
		product_descs = p.descs,
		product_type = r.product_type,
		product_type_descs = pd.descs,
		nup_type = r.nup_type,
		nup_descs =n.descs,
		phase_cd = r.phase_cd,
		phase_descs = ph.descs,
		lead_cd= mgr.cf_agent_hd.lead_cd,
		lead_name = mgr.cf_lead_agent.lead_name,
		group_cd = r.group_cd,
		group_type = mgr.cf_agent_hd.group_type,
		group_name = mgr.cf_agent_hd.group_name,
		agent_cd = r.agent_cd,
		agent_name = mgr.cf_agent_dt.agent_name,
		location_cd= r.location_cd,
		location_descs = l.descs
from mgr.rl_reserve_nup r (nolock)
inner join mgr.cf_business c (nolock)
on r.business_id = c.business_id
inner join mgr.pm_product p (nolock)
on r.entity_cd = p.entity_cd
and r.project_no = p.project_no
and r.product_cd = p.product_cd
inner join mgr.pm_product_dtl pd (nolock)
on r.entity_cd = pd.entity_cd
and r.project_no = pd.project_no
and r.product_cd = pd.product_cd
and r.product_type = pd.product_type
inner join mgr.rl_nup_type n (nolock)
on r.entity_cd = n.entity_cd
and r.project_no = n.project_no
and r.product_cd = n.product_cd
and r.nup_type = n.nup_type
inner join mgr.rl_phase ph (nolock)
on r.entity_cd = ph.entity_cd
and r.project_no = ph.project_no
and r.phase_cd = ph.phase_cd
inner join mgr.cf_location l (nolock)
on l.location_cd = r.location_cd
inner join mgr.cf_agent_hd (nolock)
on r.entity_cd = mgr.cf_agent_hd.entity_cd  and
   r.group_cd = mgr.cf_agent_hd.group_cd 
inner join mgr.cf_agent_dt (nolock)
on r.entity_cd = mgr.cf_agent_dt.entity_cd and
r.group_cd = mgr.cf_agent_dt.group_cd AND
r.agent_cd = mgr.cf_agent_dt.agent_cd 
left outer join mgr.cf_lead_agent (nolock)
on mgr.cf_agent_hd.entity_cd = mgr.cf_lead_agent.entity_cd and
mgr.cf_agent_hd.lead_cd = mgr.cf_lead_agent.lead_cd 
where  r.status not in ('C','A','B')
union

select entity_cd = r.entity_cd, 
	    project_no = r.project_no, 
		status_nup = 'C',
		business_id = r.business_id,
		business_name = c.name, 
		nup_date = mgr.rl_reserve_nup_cancel.cancel_date, 
		nup_no = r.nup_no,
		nup_amt = r.nup_amt ,  
		qty = 1,
		product_cd = r.product_cd,
		product_descs = p.descs,
		product_type = r.product_type,
		product_type_descs = pd.descs,
		nup_type = r.nup_type,
		nup_descs =n.descs,
		phase_cd = r.phase_cd,
		phase_descs = ph.descs,
		lead_cd= mgr.cf_agent_hd.lead_cd,
		lead_name = mgr.cf_lead_agent.lead_name,
		group_cd = r.group_cd,
		group_type = mgr.cf_agent_hd.group_type,
		group_name = mgr.cf_agent_hd.group_name,
		agent_cd = r.agent_cd,
		agent_name = mgr.cf_agent_dt.agent_name,
		location_cd= r.location_cd,
		location_descs = l.descs
from mgr.rl_reserve_nup r (nolock)
inner join mgr.rl_reserve_nup_cancel  (nolock)
on r.entity_cd = mgr.rl_reserve_nup_cancel.entity_cd
and r.project_no = mgr.rl_reserve_nup_cancel.project_no
and r.business_id = mgr.rl_reserve_nup_cancel.business_id
and r.nup_sequence_no = mgr.rl_reserve_nup_cancel.nup_sequence_no
inner join mgr.cf_business c (nolock)
on r.business_id = c.business_id
inner join mgr.pm_product p (nolock)
on r.entity_cd = p.entity_cd
and r.project_no = p.project_no
and r.product_cd = p.product_cd
inner join mgr.pm_product_dtl pd (nolock)
on r.entity_cd = pd.entity_cd
and r.project_no = pd.project_no
and r.product_cd = pd.product_cd
and r.product_type = pd.product_type
inner join mgr.rl_nup_type n (nolock)
on r.entity_cd = n.entity_cd
and r.project_no = n.project_no
and r.product_cd = n.product_cd
and r.nup_type = n.nup_type
inner join mgr.rl_phase ph (nolock)
on r.entity_cd = ph.entity_cd
and r.project_no = ph.project_no
and r.phase_cd = ph.phase_cd
inner join mgr.cf_location l (nolock)
on l.location_cd = r.location_cd
inner join mgr.cf_agent_hd (nolock)
on r.entity_cd = mgr.cf_agent_hd.entity_cd  and
   r.group_cd = mgr.cf_agent_hd.group_cd 
inner join mgr.cf_agent_dt (nolock)
on r.entity_cd = mgr.cf_agent_dt.entity_cd and
r.group_cd = mgr.cf_agent_dt.group_cd AND
r.agent_cd = mgr.cf_agent_dt.agent_cd 
left outer join mgr.cf_lead_agent (nolock)
on mgr.cf_agent_hd.entity_cd = mgr.cf_lead_agent.entity_cd and
mgr.cf_agent_hd.lead_cd = mgr.cf_lead_agent.lead_cd 
where  r.status = 'C'
and mgr.rl_reserve_nup_cancel.status = 'A'


CREATE TABLE [mgr].[rl_reserve_nup_cancel](
	[entity_cd] [varchar](4) NOT NULL,
	[project_no] [varchar](20) NOT NULL,
	[business_id] [varchar](20) NOT NULL,
	[nup_no] [varchar](10) NOT NULL,
	[reserve_date] [datetime] NOT NULL,
	[nup_type] [char](4) NOT NULL,
	[nup_sequence_no] [numeric](12, 0) NULL,
	[cancel_date] [datetime] NULL,
	[cancel_reason] [varchar](2) NULL,
	[cancel_staff] [varchar](10) NULL,
	[nup_amt] [decimal](21, 2) NULL,
	[remarks] [varchar](255) NULL,
	[status] [char](1) NULL,
	[trx_type] [varchar](4) NULL,
	[bank_cd] [varchar](20) NULL,
	[audit_user] [varchar](10) NULL,
	[audit_date] [datetime] NULL,
	[rowID] [numeric](12, 0) IDENTITY(1,1) NOT NULL,
	[bank_name] [varchar](60) NULL,
	[bank_acct_no] [varchar](60) NULL,
	[bank_acct_name] [varchar](60) NULL,
	[file_attachment] [varchar](60) NULL,
	[file_attached] [varbinary](max) NULL
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]



CREATE view [mgr].[v_list_city] as
SELECT
	p.*
FROM (SELECT DISTINCT
		district + ' , ' + city AS city
		,district + ' , ' + city + ' , ' + mgr.cf_province.descs AS coba
		,mgr.cf_province.rowid
		,mgr.cf_province_dtl.lead_agent_status
	
	FROM	mgr.cf_province_dtl(nolock)
			,mgr.cf_province(nolock)
	WHERE mgr.cf_province_dtl.province_cd = mgr.cf_province.province_cd) AS p
-- SELECT DISTINCT
--	city AS city 
--	, district + ' , ' +   city + ' , ' + mgr.cf_province.descs  AS coba
--	,mgr.cf_province.rowid
--FROM	mgr.cf_province_dtl (nolock)
--		,mgr.cf_province (nolock)
--WHERE mgr.cf_province_dtl.province_cd = mgr.cf_province.province_cd

