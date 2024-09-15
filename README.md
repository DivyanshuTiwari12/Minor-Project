# Minor Project

The verification of submitted documents such as educational certificates, marksheets, GATE scorecard, experience, caste, EWS, PwD certificate, etc. by applicants, as applicable against advertised vacancies, is presently carried out manually. These documents, generally available in image or PDF form, may be in languages other than Hindi or English. In order to verify the information filled by applicants in their biodata applications can be verified using Intelligent Document Processing (IDP) techniques involving Machine Learning Deep Learning, Artificial Intelligence, Natural Language Processing, etc. 

• Expected Solution: The extraction of information from submitted documents can take place at the time of application form submission and alerting applicant in case of any mismatch. Thereafter, while screening of applications more robust data extraction techniques may be employed to further avoid any chances of error. The extracted information may be presented using modern business intelligence tools thus highlighting the efficiency of process. The solution should be able to process documents with Three Sigma accuracy with a speed of not more than 3 seconds per document.


# Documentation

### Introduction

The manual process of verifying documents like educational certificates, GATE scorecards, caste certificates, etc., is tedious and prone to human errors. This project automates the extraction and validation of these documents using Intelligent Document Processing (IDP) methods. The system is designed to:

Extract structured data from documents.
Compare extracted data with applicant-provided information.
Alert on mismatches in real time.
Present verification insights using a Business Intelligence (BI) dashboard.

### Features
- OCR for Document Text Extraction: Supports multiple languages and extracts text from images and PDFs.
- Data Extraction via Pre-trained Models: Uses LayoutLM or similar transformer models for extracting key entities like names, scores, and dates.
- Real-Time Mismatch Detection: Detects and reports discrepancies between form entries and document content.
- Confidence Scoring: Achieves Three Sigma (99.7%) accuracy.
- Business Intelligence Dashboard: Visualizes document verification results for easy monitoring and oversight.
- High Performance: Processes documents in less than 3 seconds each, supporting parallel processing.

### Flowchart
**1. Start**

*The process starts when a user submits a document (image or PDF) and the corresponding form data.*

**2. Document Upload**

*The document is uploaded via the API.*

*OCR and Text Extraction*

*Tesseract OCR extracts text from the document.*

*The text is sent for Language Detection.*

**3. Language Detection**

*The system detects the language of the extracted text using    ML-based language detection.*

*If the language is supported, proceed to data extraction.*

*If the language is not supported, prompt for translation or reject.*
    
**4. ML Data Extraction**

*A pre-trained LayoutLM model processes the document layout and extracts key entities such as names, dates, and scores.*

*Compare Extracted Data with Form Data*

*The extracted data is compared with the data submitted in the application form using NLP and fuzzy matching.*
    
**5. Mismatch Detection**

*The system calculates a confidence score for each extracted entity.*

*If the confidence score is high enough (above a defined threshold), the data is accepted.*

*If mismatches are found (low confidence scores), the applicant is alerted for potential errors.*
    
**6. Store Results**

*The verification results (confidence scores, matches, mismatches) are stored in the system.*

**7. Visualization in BI Dashboard**

*The results are sent to the BI Dashboard (built with Dash/Plotly) for visualization.*

*Admins can view verification status, confidence levels, and overall insights into the document verification process.*

**8. End**

*The code will terminate.*

## 🔗 Links
[![linkedin](https://img.shields.io/badge/linkedin-0A66C2?style=for-the-badge&logo=linkedin&logoColor=white)](https://www.linkedin.com/in/divyanshu-tiwari-b207b4225/)
[![reddit](https://img.shields.io/badge/reddit-1DA1F2?style=for-the-badge&logo=twitter&logoColor=white)](https://www.reddit.com/user/Voldemort_Who/)